<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\HomeBanner;
use App\Model\Order;
use App\Model\Product;
use App\Model\TradeMark;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
//      generate_daily_visits_array();
      $products = Product::where('status', 'active')->orderBy('id', 'desc')->take(8)->get();
      $tradMarks = TradeMark::all();
      $homeBanners = HomeBanner::take(10)->get();
      $hotProducts = Product::where('status', 'active')->where('is_hot', 1)->where('start_offer_at', '<=', date("Y-m-d", time()))->take(6)->get();
      $orders = Order::orderBy('id', 'desc')->get()->transform( function( $cart, $key) {
        $cartData = $cart->cart;
        if (is_string($cartData) && !empty($cartData)) {
          return unserialize($cartData)->items;
        }
        return []; // or handle the case where cart data is not valid
      })->take(9);

      foreach($orders as $key => $order) {
        foreach(array_keys($order) as $item) {
         $productsId[] = $item;
        }
      }
      $productsId = [40, 41, 42];       // This is for test only, it must delete with production
      return view('style.home', compact('products', 'tradMarks', 'homeBanners', 'orders', 'productsId', 'hotProducts'));
    }
}
