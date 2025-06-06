<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewsRequest;
use App\Model\Color;
use App\Model\Departement;
use App\Model\Product;
use App\Helper\General\Cart;
use App\Helper\General\Wishlist;
use App\Model\Wishlist as DBWishlist;
use App\Model\Review;
use App\Model\TradeMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// use Stripe\Stripe;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

// use Cartalyst\Stripe\Stripe;

class ShopProductsController extends Controller
{

  public function index($sort, $id = null)
  {
    $prices = [];         // array to store all products prices
    visits('App\Model\Product')->increment();
    if (!is_null($id) && is_numeric($id)) {
      $products = Product::where('department_id', $id)->where('status', 'active')->orderBy('id', $sort)->paginate(12);
    } else {
      $products = Product::where('status', 'active')->orderBy('id', $sort)->paginate(12);
    }

    $allProductsPrices = Product::select('price')->where('status', 'active')->get();
    $productsCount = $allProductsPrices->count();
    $categories = Departement::with(['sons' => function($query) {
      $query->with(['sons' => function($query) {
        $query->withCount('products');  // Count products for each son category
      }])->withCount('products');  // Count products for each son category
    }])->withCount('products')->get();
    $colors = Color::select('id', 'colors_name_ar', 'colors_name_en')
      ->withCount(['products as active_products_count' => function ($query) use ($id) {
        if (!is_null($id) && is_numeric($id)) $query->where('department_id', $id);
        $query->where('status', 'active');
      }])->get();
    $brands = TradeMark::select('id', 'trademarks_name_ar', 'trademarks_name_en')
      ->withCount(['products as active_products_count' => function ($query) use ($id) {
        if (!is_null($id) && is_numeric($id)) $query->where('department_id', $id);
        $query->where('status', 'active');
      }])->get();
    // Get Max And Min Price
    foreach($allProductsPrices as $price) {
      array_push($prices, $price->price);
    }
    $maxPrice = max($prices);
    $minPrice = min($prices);
    return view('style.shop.index', compact('products', 'categories', 'colors', 'brands', 'productsCount', 'sort', 'maxPrice', 'minPrice'));
  }

  public function ajaxFilterProducts(Request $request)
  {
    if ($request->ajax()) {
      $data = $request->all();
      if (isset($data['categoryId']) && !is_null($data['categoryId'])) {
        $dataIn['department_id'] = $data['categoryId'];
      }
      if (isset($data['color']) && ($data['color'] != 0 && !is_null($data['color']))) {
        $dataIn['color_id'] = $data['color'];
      }
      if (isset($data['brand']) && ($data['brand'] != 0 && !is_null($data['brand']))) {
        $dataIn['trade_id'] = $data['brand'];
      }
      $dataIn[] = ['price', '>=', $data['lowerPrice']];
      $dataIn[] = ['price', '<=', $data['upperPrice']];
      $products = Product::where('status', 'active')->where($dataIn)->get();
      return view('style.shop.list-ajax-filter', compact('products'))->render();
    }
  }

  public function addToCart(Request $request, $id)
  {
    if ($request->ajax()) {
      $cartProducts = '';
      // Fetch The Product
      $product = Product::find($id);
      // fetch the old cart if it was exists and stored in the session
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);                 // Create New Cart
      $cart->add($product, $product->id);         // Add New Product To Cart
      If ($request->qty > 1) {
        $cart->updateQty($product->id, $request->qty);
      }
//      dd($cart);
      $request->session()->put('cart', $cart);    // Stored Product inside Cart
      $totalQty = session('cart')->totalQty;
      $totalPrice = session('cart')->totalPrice;
      if ($request->session()->has('cart')):
        foreach ($request->session()->get('cart')->items as $item):
          $cartProducts .= '<li class="clearfix" style="direction: ' . (lang() == 'en' ? 'rtl' : 'ltr') . '">
                                <div class="">
                                    <img src="' . Storage::url($item['photo']) . '" alt="item1" width="70" height="70" />
                                </div>
                                <div class="w-100 text-left">
                                    <div class="item-name" title="' . $item['item']->{'title_' . lang()} . '"><strong>' . substr($item['item']->{'title_' . lang()}, 0, 15) . '</strong></div>
                                    <div  style="direction: ' . (lang() == 'ar' ? 'rtl' : 'ltr') . '" class="item-price ' . (lang() == 'en' ? 'pl-3' : 'pr-3') . '">' . trans('product.price') . ': ' . ' ' . $item['price'] . '</div>
                                    <div class="item-quantity ' . (lang() == 'en' ? 'pl-3' : 'pr-3') . '">' . trans('product.quantity') . ': ' . $item['qty'] . '</div>
                                </div>
                              </li>';
        endforeach;
      endif;
      return response()->json([
        'success' => trans('product.add-to-cart-success'),
        'cartProducts' => json_encode($cartProducts, JSON_INVALID_UTF8_IGNORE),
        'totalQty' => (string)$totalQty,
        'totalPrice' => (string)$totalPrice,
      ], Response::HTTP_OK);
    }
  }


  public function shoppingCarts()
  {
    if (!Session::has('cart')) {
      return view('style.orders.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    return view('style.orders.shopping-cart', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice]);
  }

  public function emptyCart()
  {
    // check if there is items stored in session
    if (session()->has('cart')) {
      session()->forget('cart');
      return back();
    }
    return back();
  }

  public function wishlist()
  {
    if (!session()->has('wishlist')) {
      return view('style.orders.wishlist');
    }
    $oldWishlist = session('wishlist');
    $wishlist = new Wishlist($oldWishlist);
    return view('style.orders.wishlist', ['items' => $wishlist->items]);
  }

  public function addToWishlist(Request $request)
  {
    if ($request->ajax()) {
      if (!auth()->check()) {
        return response()->json(['error' => trans('product.wishlist-not-authorize')], Response::HTTP_UNAUTHORIZED);
      }
      $product = Product::find($request->id);             // Fetch The Product
      // fetch the old cart if it was exists and stored in the session
      $oldWishlist = session()->has('wishlist') ? session('wishlist') : null;
      $wishlist = new Wishlist($oldWishlist);             // Create New Wishlist
      $wishlist->add($product, $product->id);             // Add New Product To Wishlist
      $request->session()->put('wishlist', $wishlist);    // Stored Product inside Wishlist
      $this->storeWishlist($wishlist);                    // Store Wishlist in Database
      $totalQty = session('wishlist')->totalQty;
      return response()->json([
        'success' => trans('product.add-to-wishlist-success'),
        'totalQty' => $totalQty,
      ], Response::HTTP_OK);
    } else {
      return response()->json(['error' => trans('product.wishlist-not-authorize')], Response::HTTP_UNAUTHORIZED);
    }
  }


  private function storeWishlist($wishlist)
  {
    $DbWishlist = DBWishlist::where('user_id', auth()->id())->first();
    if (is_null($DbWishlist)) {
      auth()->user()->wishlist()->create([
        'wishlist' => serialize($wishlist)
      ]);
    } else {
      auth()->user()->wishlist()->update([
        'wishlist' => serialize($wishlist)
      ]);
    }
  }

  private function dbRemoveWishlist()
  {
    $DbWishlist = DBWishlist::where('user_id', auth()->id())->first();
    if ($DbWishlist) {
      $DbWishlist->delete();
    }
  }

  public function emptyWishlist()
  {
    // check if there is items stored in session
    if (session()->has('wishlist')) {
      session()->forget('wishlist');
      $this->dbRemoveWishlist();
      return back();
    }
  }

  public function removeWishlistItem($id)
  {
    if (session()->has('wishlist')) {
      $wishlist = new Wishlist(session('wishlist'));
      $wishlist->remove($id);
      if ($wishlist->totalQty <= 0) {
        session()->forget('wishlist');
        $this->dbRemoveWishlist();
      } else {
        session()->put('wishlist', $wishlist);
        $this->storeWishlist($wishlist);
      }
      return back()->with('success', trans('product.delete-wishlist-item-success-msg'));
    }
  }

  public function checkout()
  {
    if (!Session::has('cart')) {
      return view('style.orders.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrice;
    return view('style.orders.checkout', ['total' => $total]);
  }


  public function charge(Request $request)
  {

    // try {
    $charge = Stripe::charges()->create([
      'currency' => 'USD',
      'source' => $request->stripeToken,
      'amount' => $request->amount,
      'description' => 'Test From Laravel'
    ]);
    // } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
    //     return $e->getMessage();
    // }


    $chargeId = $charge['id'];

    // Check if There is Charge id Return From Stripe Account
    if ($chargeId) {
      // Save Order
      if (session()->has('cart')) {
        auth()->user()->orders()->create([
          'cart' => serialize(session()->get('cart'))
        ]);
      }
      session()->forget('cart');
      return redirect(url('/'))->with('success', 'Payment Was Done. Thanks');
    } else {
      return back();
    }
  }

  public function search(Request $request)
  {
    if ($request->ajax()) {
      $result = '';
      $products = Product::where('title_' . lang(), 'LIKE', '%' . $request->value . '%')->take(30)->get();
      $style = '<style>
                  .product-home .prd-bottom {
                    position: absolute;
                    top: 42%;
                    left: -32px;
                    transition: all 0.3s ease 0s;
                    background: linear-gradient(180deg, rgb(255, 255, 255), transparent);
                    padding: 6px;
                    border-top-right-radius: 5px;
                  }
                  .product-home:hover .prd-bottom { left: 0 !important; }
                  .product-home:hover .prd-bottom .social-info { color: #092147; }
                  .product-home:hover .prd-bottom .social-info:hover { color: #1A488E;}
                  .wishlist-added i { color: #97B2DE !important;}
                </style>';
      $result .= '<div class="container"><div class="row">' . $style;
      if ($products->isNotEmpty()) {
        foreach($products as $product) {
          if (auth()->check()) {
            $wishListClass = (session()->has('wishlist') && isset(session('wishlist')->items[$product->id])) ? 'wishlist-added' : '';
          } else {
            $wishListClass = '';
          }
          $result .= '<div class="col-6 col-md-4 col-lg-3 mb-4 mx-auto">' . view('style.shop.product-template', compact('product', 'wishListClass')) . '</div>';
        }
      } else {
        $result .= '<div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto text-center"><p class="mb-0 empty-result">' . trans('product.empty-result'). '</p></div>';
      }
      $result .= '</div></div>';
      return response()->json(['result' => $result], Response::HTTP_OK);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $product = Product::findOrFail($id);
    return view('style.shop.view', compact('product'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  public function update(Request $request, $id)
  {
    if ($request->ajax()) {
      $validator = Validator::make($request->all(), [
        'qty' => 'required|numeric'
      ]);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
      }
      $oldCart = session()->has('cart') ? session('cart') : null;
      $cart = new Cart($oldCart);
      $cart->updateQty($id, $request->qty);
      session()->put('cart', $cart);
      $productPrice = session('cart')->items[$id]['price'];
//      $currency = session('cart')->items[$id]['item']->currency->Symbol;
      $totalQty = session('cart')->totalQty;
      $totalPrice =  session('cart')->totalPrice;
      return response()->json([
        'success' => trans('product.update-cart-item-qty-success-msg'),
        'qty' => $request->qty,
        'price' => $productPrice,
//        'currency' => $currency,
        'totalQty' => $totalQty,
        'totalPrice' => $totalPrice,
      ], Response::HTTP_OK);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id)
  {
    if (session()->has('cart')) {
      $cart = new Cart( session('cart') );
      $cart->remove($id);
      // Check IF still there item inside shopping-cart or not
      if ($cart->totalQty <= 0) {
        session()->forget('cart');
      } else {
        session()->put('cart', $cart);
      }
      return redirect(url('cart'))->with('success', 'Product Was Removed Successfully');
    }
    return back();
  }

  public function ajax_new_review(Request $request)
  {
    if ($request->ajax()) {
      $validator = Validator::make($request->all(), [
        'reviewer_name' => 'required|string',
        'review_text' => 'required|string',
        'review' => 'required|string|in:1,2,3,4,5',
        'product_id' => 'required|numeric'
      ]);
      if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
      }
      $product = Product::find($request->product_id);
      if (is_null($product)) {
        return response()->json(['error' => trans('admin.wrong_product_id_msg')], Response::HTTP_BAD_REQUEST);
      }
      Review::create($request->all());
      return response()->json(['success' => trans('product.review-wait-message')]);
    }
  }
}
