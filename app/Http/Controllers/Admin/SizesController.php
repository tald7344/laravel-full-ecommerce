<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\SizeDatatable;
use App\Http\Requests\SizeRequest;
use App\Model\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizeDatatable $sizes)
    {
        return $sizes->render('admin.sizes.index', ['title' => trans('admin.sizePanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create', ['title' => trans('admin.new_size')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeRequest $request)
    {
        Size::create($request->all());
        return redirect(aurl('size'))->with('success', trans('admin.create_success'));
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
    public function edit(Size $size)
    {
        return view('admin.sizes.edit', ['title' => trans('admin.edit_size_page'), 'size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SizeRequest $request, Size $size)
    {
        $size->update($request->all());
        return redirect(aurl('size'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return redirect(aurl('size'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('size'))->with('error', trans('admin.please_check_record_number'));
        }
        // destory : it Make the Delete based on the number of request items it received
        Size::destroy(request('items'));
        return redirect(aurl('size'))->with('success', trans('admin.delete_success'));
    }
}
