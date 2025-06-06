<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\MallDatatable;
use App\Model\Mall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallDatatable $malls)
    {
        return $malls->render('admin.malls.index', ['title' => trans('admin.mallPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.malls.create', ['title' => trans('admin.new_mall')]);
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
            'malls_name_ar'         => 'required',
            'malls_name_en'         => 'required',            
            'country_id'            => 'required',
            'facebook'              => 'sometimes|nullable',
            'twitter'               => 'sometimes|nullable',
            'website'               => 'sometimes|nullable',
            'contact_name'          => 'sometimes|nullable',
            'mobile'                => 'sometimes|nullable',
            'address'               => 'sometimes|nullable',
            'email'                 => 'sometimes|nullable',
            'lat'                   => 'sometimes|nullable',
            'lag'                   => 'sometimes|nullable',
            'image'                  => 'sometimes|nullable|' . VImage()
        ]);    
        // Check if there is image upload on the request
        if ($request->hasFile('image')) {
            $data['image'] = up()->upload([
                'file' => 'image',
                'path' => 'malls',
                'upload_type' => 'single',
                'delete_file' => ''
            ]);
        }
        Mall::create($data);
        return redirect(aurl('mall'))->with('success', trans('admin.create_success'));
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
    public function edit(Mall $mall)
    {
        return view('admin.malls.edit', ['title' => trans('admin.edit_mall_page'), 'mall' => $mall]);
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
            'malls_name_ar'         => 'required',
            'malls_name_en'         => 'required',
            'country_id'            => 'required',            
            'facebook'              => 'sometimes|nullable',
            'twitter'               => 'sometimes|nullable',
            'website'               => 'sometimes|nullable',
            'contact_name'          => 'sometimes|nullable',
            'mobile'                => 'sometimes|nullable',
            'address'               => 'sometimes|nullable',
            'email'                 => 'sometimes|nullable',
            'lat'                   => 'sometimes|nullable',
            'lag'                   => 'sometimes|nullable',
            'image'                  => 'sometimes|nullable|' . VImage()
        ]);    
        // Check if there is image upload on the request
        if ($request->hasFile('image')) {
            $data['image'] = up()->upload([
                'file'          => 'image',
                'path'          => 'malls',
                'upload_type'   => 'single',
                'delete_file'   => Mall::find($id)->image,                
            ]);
        }
        Mall::where('id', $id)->update($data);
        return redirect(aurl('mall'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mall $mall)
    {
        Storage::delete($mall->image);
        $mall->delete();
        return redirect(aurl('mall'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('mall'))->with('error', trans('admin.please_check_record_number'));
        }
        foreach (request('items') as $id) {
            $malls = Mall::find($id);
            Storage::delete($malls->image);
        }
        // destory : it Make the Delete based on the number of request items it received
        Mall::destroy(request('items'));
        return redirect(aurl('mall'))->with('success', trans('admin.delete_success'));
    }
}
