<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\CitiesDatatable;
use App\Http\Requests\CitiesRequest;
use App\Model\city;


class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CitiesDatatable $cities)
    {
        return $cities->render('admin.cities.index', ['title' => trans('admin.cityPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create', ['title' => trans('admin.new_city')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CitiesRequest $request)
    {
        City::create($request->all());
        return redirect(aurl('city'))->with('success', trans('admin.create_success'));
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
    public function edit(City $city)
    {
        return view('admin.cities.edit', ['title' => trans('admin.edit_city_page'), 'city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CitiesRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect(aurl('city'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect(aurl('city'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('city'))->with('error', trans('admin.please_check_record_number'));
        }
        // destory : it Make the Delete based on the number of request items it received
        City::destroy(request('items'));
        return redirect(aurl('city'))->with('success', trans('admin.delete_success'));
    }
}
