<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\StateDatatable;
use App\Http\Requests\StatesRequest;
use App\Model\City;
use App\Model\State;
// use Form;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateDatatable $states)
    {
        return $states->render('admin.states.index', ['title' => trans('admin.statePanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check If There Is Ajax Request Or Not
        if (request()->ajax()) {
            // Check IF There Is Data Sending From Ajax
            if (request()->has('country_id')) {
                $select = request()->has('select') ? request()->select : '';
                return \Form::select('city_id', City::pluck('cities_name_' . session('lang'), 'id'), $select, ['class' => 'form-control'] );
            }
        }
        return view('admin.states.create', ['title' => trans('admin.new_state')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatesRequest $request)
    {
        State::create($request->all());
        return redirect(aurl('state'))->with('success', trans('admin.create_success'));
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
    public function edit(State $state)
    {
        return view('admin.states.edit', ['title' => trans('admin.edit_state_page'), 'state' => $state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatesRequest $request, State $state)
    {
        $state->update($request->all());
        return redirect(aurl('state'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        return redirect(aurl('state'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('state'))->with('error', trans('admin.please_check_record_number'));
        }
        // destory : it Make the Delete based on the number of request items it received
        State::destroy(request('items'));
        return redirect(aurl('state'))->with('success', trans('admin.delete_success'));
    }
}
