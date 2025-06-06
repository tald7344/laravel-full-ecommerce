<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\WeightDatatable;
use App\Http\Requests\WeightRequest;
use App\Model\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WeightDatatable $weights)
    {
        return $weights->render('admin.weights.index', ['title' => trans('admin.weightPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weights.create', ['title' => trans('admin.new_weight')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WeightRequest $request)
    {
        Weight::create($request->all());
        return redirect(aurl('weight'))->with('success', trans('admin.create_success'));
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
    public function edit(Weight $weight)
    {
        return view('admin.weights.edit', ['title' => trans('admin.edit_weight_page'), 'weight' => $weight]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WeightRequest $request, Weight $weight)
    {
        $weight->update($request->all());
        return redirect(aurl('weight'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weight $weight)
    {
        $weight->delete();
        return redirect(aurl('weight'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('weight'))->with('error', trans('admin.please_check_record_number'));
        }
        // destory : it Make the Delete based on the number of request items it received
        Weight::destroy(request('items'));
        return redirect(aurl('weight'))->with('success', trans('admin.delete_success'));
    }
}
