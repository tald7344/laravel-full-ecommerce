<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\ProductDatatable;
use App\Model\Country;
use App\Model\File;
use App\Model\MallProduct;
use App\Model\OtherData;
use App\Model\Product;
use App\Model\RelatedProduct;
use App\Model\Size;
use App\Model\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDatatable $products)
    {
        return $products->render('admin.products.index', ['title' => trans('admin.productPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $product = Product::create(['title_en' => '', 'title_ar' => '', 'price' => 0]);
      if (!empty($product)) {
        return redirect(aurl('product/'.$product->id.'/edit'));
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     Product::create($request->all());
    //     return redirect(aurl('Product'))->with('success', trans('admin.create_success'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$product = Product::find($id);
		return view('admin.products.product', ['title' => trans('admin.create_or_edit_product', ['title' => $product->{'title_' . lang()}]), 'product' => $product])->render();
	}


    public function update_main_photo($id)
    {
        if (request()->hasFile('file')) {
            Product::where('id', $id)->update([
                'photo' => up()->upload([
                    'file'          => 'file',
                    'path'          => 'products/' . $id,
                    'upload_type'   => 'single',
                    'file_type'     => 'product',
                    'delete_file'   => ''
                ])
            ]);
            return response(['status' => true], 200);
        }
    }

    /**
     * Handle images(single/multi) upload using dropzone library
     *
     */
    public function upload_file($id)
    {
        if (request()->hasFile('file')) {
            $fid = up()->upload([
                'file'          => 'file',
                'path'          => 'products/' . $id,
                'upload_type'   => 'files',
                'file_type'     => 'product',
                'relation_id'   => $id
            ]);
            return response(['status' => true, 'id' => $fid], 200);
        }
    }


    public function delete_file()
    {
        if (request()->has('id')) {
            up()->delete(request('id'));
        }
    }

    public function delete_main_photo()
    {
        $product = Product::find(request('id'));
        if (!empty($product)) {
            Storage::delete($product->photo);
            $product->photo = null;
            $product->save();
            return response(['status' => true], 200);
        }
    }

    public function load_weight_size()
    {
        if (request()->ajax() && request()->has('dep_id')) {
            // remove the repeated value from array using array_diff
            $departmentsParents = array_diff(explode(', ', get_parents(request('dep_id'))), [request('dep_id')]);
            // fetch all parents sizes that is public only
            $sizes = Size::where('is_public', 'yes')->whereIn('department_id', $departmentsParents)->orWhere('department_id', request('dep_id'))->pluck('sizes_name_' . session('lang'), 'id');
            $weights = Weight::pluck('weights_name_'.session('lang'), 'id');
            return view('admin.products.ajax.size_weight', [
                'sizes' => $sizes,
                'weights' => $weights,
                'product' => Product::find(request('product_id'))])->render();
        } else {
          return trans('admin.please-select-department');
        }
    }

    public function ajax_get_country_details(Request $request) {
      if ($request->ajax()) {
        $country = Country::find($request->country_id);
        if (is_null($country)) {
          return response()->json(['error' => trans('admin.country_id_invalid')], Response::HTTP_NOT_FOUND);
        }
        // Create Array of object for Select2 Malls tags
        $objectOne = new \stdClass();
        $objectOne->text = $country->{'countries_name_' . session('lang')};
        $objectOne->children = [];
        foreach($country->malls()->get() as $mall):
          $objectTwo = new \stdClass();
          $objectTwo->id = $mall->id;
          $objectTwo->text = $mall->{'malls_name_'.session('lang')};
          if(mall_check($request->product_id, $mall->id)):
            $objectTwo->selected = true;
          endif;
          $objectOne->children[] = $objectTwo;
        endforeach;
        $result[] = $objectOne;
        return response()->json(['result' => $result], Response::HTTP_OK);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product)
    {
        $data = $this->validate(request(), [
            'title_en'          => 'required|max:190',
            'title_ar'          => 'required|max:190',
            'content_en'        => 'required',
            'content_ar'        => 'required',
            'department_id'  => 'required|numeric',
            'trade_id'       => 'required|numeric',
            'manufactory_id' => 'required|numeric',
            'color_id'       => 'sometimes|nullable|numeric',
            'size_id'        => 'sometimes|nullable|numeric',
            'size'           => 'sometimes|nullable',
            'currency_id'    => 'required|numeric',
            'price'          => 'required|numeric',
            'stock'          => 'required|numeric',
            'start_at'       => 'sometimes|nullable|date',
            'end_at'         => 'sometimes|nullable|date',
            'start_offer_at' => 'sometimes|nullable|date',
            'end_offer_at'   => 'sometimes|nullable|date',
            'price_offer'    => 'sometimes|nullable|numeric',
            'weight'         => 'sometimes|nullable',
            'weight_id'      => 'sometimes|nullable|numeric',
            'status'         => 'sometimes|nullable|in:pending,refused,active',
            'reason'         => 'sometimes|nullable|numeric',
        ]);

        // Fetch Mall Data to use it with select2 library
        if (request()->has('mall')) {
            MallProduct::where('product_id', $product->id)->delete();
            foreach(request('mall') as $mall) {
                MallProduct::create([
                    'product_id' => $product->id,
                    'mall_id' => $mall
                ]);
            }
        }

        // get the related product (product copied from this product but with some different features)
        if (request()->has('related')) {
          RelatedProduct::where('product_id', $product->id)->delete();
          foreach (request('related') as $related) {
            RelatedProduct::create([
                'product_id'       => $product->id,
                'relation_product' => $related,
              ]);
          }
        }

        // Store OtherData Data
        if (request()->has('input_keys_ar') && request()->has('input_keys_en') && request()->has('input_values')) {
            $i = 0;
            $other_data = '';
            OtherData::where('product_id', $product->id)->delete();
            foreach(request('input_keys_en') as $indexEn => $key) {
                $value = !empty(request('input_values')[$i]) ? request('input_values')[$i] : '';
                $dataArray = [
                  'product_id' => $product->id,
                  'data_key_en' => $key,
                  'data_key_ar' => '',
                  'data_value' => $value
                ];
                foreach(request('input_keys_ar') as $indexAr => $keyAr) {
                  if ($indexEn == $indexAr) {
                    $dataArray['data_key_ar'] = $keyAr;
                  }
                }
                OtherData::create($dataArray);
                $i++;
            }
            $data['other_data'] = rtrim($other_data, '|');
        }
        $product->update($data);
        return response(['status' => true, 'message' => trans('admin.update_success')], 200);
    }


    /**
     * Copy the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function copy_product($id)
    {
        // Check if the request is ajax request
        if (request()->ajax()) {
            $productJson = Product::find($id);
            $product = $productJson->toArray();       // fetch the product wants to copied it and convert it to array
            unset($product['id']);                          // remove the id from it
            $copiedProduct = Product::create($product);    // create new product with the same information
            // Copy The Main Product Image
            if (!empty($product['photo'])) {
                $ext = \File::extension($product['photo']);         // image extension 'png'
                $newName = \Str::random(32) . '.' . $ext;           // new image name with extension
                $newPath = 'products/' . $copiedProduct->id . '/' . $newName;
                Storage::copy($product['photo'], $newPath);         // copy the old image to new one
                $copiedProduct->photo = $newPath;
                $copiedProduct->save();
            }
            // Fetch the secondary images for that product will copied it
            $files = File::where('file_type', 'product')->where('relation_id', $id)->get();
            if (count($files) > 0) {
                foreach($files as $file) {
                    $ext = \File::extension($file->file);
                    $hashName = \Str::random(30) . '.' . $ext;
                    $newPath = 'products/' . $copiedProduct->id . '/' . $hashName;
                    Storage::copy($file->full_file, $newPath);
                    File::create([                                  // Store all image information inside files Table
                        'name'          => $file->name,
                        'size'          => $file->size,
                        'file'          => $hashName,
                        'path'          => 'products/' . $copiedProduct->id,
                        'full_file'     => $newPath,                // get full image path
                        'mime_type'     => $file->mime_type,
                        'file_type'     => 'product',               // used to refer that this image is back to the product image
                        'relation_id'   => $copiedProduct->id       // use to refer to product image id
                    ]);
                }
            }
            // Fetch Mall Data to use it with select2 library
            foreach($productJson->malls()->get() as $mall) {
                MallProduct::create([
                    'product_id'    => $copiedProduct->id,
                    'mall_id'       => $mall->mall_id
                ]);
            }


            $otherDatas = $productJson->otherData()->get();
            if (!empty($otherDatas)) {
                foreach($otherDatas as $otherData) {
                    OtherData::create([
                        'product_id'    => $copiedProduct->id,
                        'data_key_ar'   => $otherData->data_key_ar,
                        'data_key_en'   => $otherData->data_key_en,
                        'data_value'    => $otherData->data_value
                    ]);
                }
            }
            return response(['status' => true, 'message' => trans('admin.copied_success')], 200);
        }
    }


    /**
     * Search Method.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search_product()
    {
        // Check if the request is ajax request
        if (request()->ajax()) {
            if (request()->has('search') && !empty(request('search')) ) {
                $relatedProduct = RelatedProduct::where('product_id', request('id'))->get(['relation_product']);
                $searchResult = Product::where('title_' . lang(), 'LIKE', '%' . request('search') . '%')
                                        ->where('id', '!=', request('productId'))
                                        ->whereNotIn('id', $relatedProduct)
                                        ->limit(10)
                                        ->get();
                return response([
                    'status' => true,
                    'result' => count($searchResult) > 0 ? $searchResult : '',
                    'total_result' => count($searchResult)
                ], 200);
            }
        }
    }



    public function deleteProduct($id) {
		$products = Product::find($id);
		!empty($products->photo)?Storage::delete($products->photo):'';
		up()->delete_files($id);
		$products->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteProduct($id);
        return redirect(aurl('product'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
      if (is_array(request('items'))) {
        foreach (request('items') as $id) {
          $this->deleteProduct($id);
        }
      } else {
  			$this->deleteProduct(request('items'));
      }
        return redirect(aurl('product'))->with('success', trans('admin.delete_success'));
    }


  public function product_hot_offer(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'is_hot' => 'required|in:0,1'
    ]);
    if ($validator->fails()) {
      return redirect(aurl('product'))->with('error', trans('admin.wrong_hot_id_msg'));
    }
    $product = Product::find($request->id);
    if (is_null($product)) {
      return redirect(aurl('product'))->with('error', trans('admin.wrong_id_msg'));
    }
    $product->is_hot = $request->is_hot;
    $product->save();
    return redirect(aurl('product'));
  }
}
