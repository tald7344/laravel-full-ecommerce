<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\CountriesDatatable;
use App\Model\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDatatable $countries)
    {
        return $countries->render('admin.countries.index', ['title' => trans('admin.countryPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create', ['title' => trans('admin.new_country')]);
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
            'countries_name_ar' => 'required|max:190',
            'countries_name_en' => 'required|max:190',
            'mob' => 'required',
            'code' => 'required',
            'currency' => 'required',
            'logo' => 'sometime|nullable|' . VImage()
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'countries',
                'upload_type' => 'single',
                'delete_file' => ''
            ]);
        }
        Country::create($data);
        return redirect(aurl('country'))->with('success', trans('admin.create_success'));
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
    public function edit(Country $country)
    {
        return view('admin.countries.edit', ['title' => trans('admin.edit_country_page'), 'country' => $country]);
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
            'countries_name_ar' => 'required',
            'countries_name_en' => 'required',
            'mob' => 'required',
            'code' => 'required',
            'currency' => 'required',
            'logo' => 'sometimes|nullable|' . VImage()
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'countries',
                'upload_type' => 'single',
                'delete_file' => Country::find($id)->logo,
            ]);
        }
        Country::where('id', $id)->update($data);
        return redirect(aurl('country'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        Storage::delete($country->logo);
        $country->delete();
        return redirect(aurl('country'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('country'))->with('error', trans('admin.please_check_record_number'));
        }
        foreach (request('items') as $id) {
            $countries = Country::find($id);
            Storage::delete($countries->logo);
        }
        // destory : it Make the Delete based on the number of request items it received
        Country::destroy(request('items'));
        return redirect(aurl('country'))->with('success', trans('admin.delete_success'));
    }
}
