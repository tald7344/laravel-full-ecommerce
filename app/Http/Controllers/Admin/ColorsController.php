<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\ColorDatatable;
use App\Http\Requests\ColorRequest;
use App\Model\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ColorDatatable $colors)
    {
        return $colors->render('admin.colors.index', ['title' => trans('admin.colorPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create', ['title' => trans('admin.new_color')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorRequest $request)
    {
        Color::create($request->all());
        return redirect(aurl('color'))->with('success', trans('admin.create_success'));
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
    public function edit(Color $color)
    {
        return view('admin.colors.edit', ['title' => trans('admin.edit_color_page'), 'color' => $color]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColorRequest $request, Color $color)
    {
        $color->update($request->all());
        return redirect(aurl('color'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect(aurl('color'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('color'))->with('error', trans('admin.please_check_record_number'));
        }
        // destory : it Make the Delete based on the number of request items it received
        Color::destroy(request('items'));
        return redirect(aurl('color'))->with('success', trans('admin.delete_success'));
    }
}
