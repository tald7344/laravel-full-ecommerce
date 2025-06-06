<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\ShippingDatatable;
use App\Model\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDatatable $shippings)
    {
        return $shippings->render('admin.shippings.index', ['title' => trans('admin.shippingPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shippings.create', ['title' => trans('admin.new_shipping')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'shippings_name_ar'     => 'required',
            'shippings_name_en'     => 'required',            
            'user_id'               => 'required',
            'lat'                   => 'sometimes|nullable',
            'lag'                   => 'sometimes|nullable',
            'icon'                  => 'sometimes|nullable|' . VImage()
        ]);    
        // Check if there is image upload on the request
        if ($request->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file'          => 'icon',
                'path'          => 'shippings',
                'upload_type'   => 'single',
                'delete_file'   => ''
            ]);
        }
        Shipping::create($data);
        return redirect(aurl('shipping'))->with('success', trans('admin.create_success'));
    }

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
    public function edit(Shipping $shipping)
    {
        return view('admin.shippings.edit', ['title' => trans('admin.edit_shipping_page'), 'shipping' => $shipping]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'shippings_name_ar'     => 'required',
            'shippings_name_en'     => 'required',            
            'user_id'               => 'required',
            'lat'                   => 'sometimes|nullable',
            'lag'                   => 'sometimes|nullable',
            'icon'                  => 'sometimes|nullable|' . VImage()
        ]);    
        // Check if there is image upload on the request
        if ($request->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file'          => 'icon',
                'path'          => 'shippings',
                'upload_type'   => 'single',
                'delete_file'   => Shipping::find($id)->icon,                
            ]);
        }
        Shipping::where('id', $id)->update($data);
        return redirect(aurl('shipping'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        Storage::delete($shipping->icon);
        $shipping->delete();
        return redirect(aurl('shipping'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('Shipping'))->with('error', trans('admin.please_check_record_number'));
        }
        foreach (request('items') as $id) {
            $shippings = Shipping::find($id);
            Storage::delete($shippings->icon);
        }
        // destory : it Make the Delete based on the number of request items it received
        Shipping::destroy(request('items'));
        return redirect(aurl('shipping'))->with('success', trans('admin.delete_success'));
    }
}
