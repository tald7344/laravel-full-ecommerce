<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\LinksDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinksRequest;
use App\Model\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LinksDatatable $links)
    {
        return $links->render('admin.links.index', ['title' => trans('admin.linkPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.links.create', ['title' => trans('admin.new_link')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinksRequest $request)
    {
        Link::create($request->all());
        return redirect(aurl('link'))->with('success', trans('admin.create_success'));
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
    public function edit(Link $link)
    {
        return view('admin.links.edit', ['title' => trans('admin.edit_link_page'), 'link' => $link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinksRequest $request, Link $link)
    {
        $link->update($request->all());
        return redirect(aurl('link'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        if ($link->sons->isNotEmpty()) {
          foreach($link->sons as $son) {
            $son->delete();
          }
        }
        $link->delete();
        return redirect(aurl('link'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('link'))->with('error', trans('admin.please_check_record_number'));
        }
        // destory : it Make the Delete based on the number of request items it received
        Link::destroy(request('items'));
        return redirect(aurl('link'))->with('success', trans('admin.delete_success'));
    }
}
