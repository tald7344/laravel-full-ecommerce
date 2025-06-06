<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\ManufactoryDatatable;
use App\Model\Manufactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManufactoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufactoryDatatable $manufactories)
    {
        return $manufactories->render('admin.manufactories.index', ['title' => trans('admin.manufactoryPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufactories.create', ['title' => trans('admin.new_manufactory')]);
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
            'manufactories_name_ar' => 'required',
            'manufactories_name_en' => 'required',            
            'facebook'              => 'sometimes|nullable',
            'twitter'               => 'sometimes|nullable',
            'website'               => 'sometimes|nullable',
            'contact_name'          => 'sometimes|nullable',
            'mobile'                => 'sometimes|nullable',
            'address'               => 'sometimes|nullable',
            'email'                 => 'sometimes|nullable',
            'lat'                   => 'sometimes|nullable',
            'lag'                   => 'sometimes|nullable',
            'icon'                  => 'sometimes|nullable|' . VImage()
        ]);    
        // Check if there is image upload on the request
        if ($request->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'manufactories',
                'upload_type' => 'single',
                'delete_file' => ''
            ]);
        }
        Manufactory::create($data);
        return redirect(aurl('manufactory'))->with('success', trans('admin.create_success'));
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
    public function edit(Manufactory $manufactory)
    {
        return view('admin.manufactories.edit', ['title' => trans('admin.edit_manufactory_page'), 'manufactory' => $manufactory]);
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
            'manufactories_name_ar' => 'required',
            'manufactories_name_en' => 'required',            
            'facebook'              => 'sometimes|nullable',
            'twitter'               => 'sometimes|nullable',
            'website'               => 'sometimes|nullable',
            'contact_name'          => 'sometimes|nullable',
            'mobile'                => 'sometimes|nullable',
            'address'               => 'sometimes|nullable',
            'email'                 => 'sometimes|nullable',
            'lat'                   => 'sometimes|nullable',
            'lag'                   => 'sometimes|nullable',
            'icon'                  => 'sometimes|nullable|' . VImage()
        ]);    
        // Check if there is image upload on the request
        if ($request->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'manufactories',
                'upload_type' => 'single',
                'delete_file' => Manufactory::find($id)->icon,                
            ]);
        }
        Manufactory::where('id', $id)->update($data);
        return redirect(aurl('manufactory'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufactory $manufactory)
    {
        Storage::delete($manufactory->icon);
        $manufactory->delete();
        return redirect(aurl('manufactory'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('manufactory'))->with('error', trans('admin.please_check_record_number'));
        }
        foreach (request('items') as $id) {
            $manufactories = Manufactory::find($id);
            Storage::delete($manufactories->icon);
        }
        // destory : it Make the Delete based on the number of request items it received
        Manufactory::destroy(request('items'));
        return redirect(aurl('manufactory'))->with('success', trans('admin.delete_success'));
    }
}
