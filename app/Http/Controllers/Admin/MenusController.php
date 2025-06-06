<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\MenuDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Model\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenuDatatable $menus)
    {
        return $menus->render('admin.menu.index', ['title' => trans('admin.menuPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create', ['title' => trans('admin.new_menu')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        Menu::create($request->all());
        return redirect(aurl('menu'))->with('success', trans('admin.create_success'));
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
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', ['title' => trans('admin.edit_menu_page'), 'menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->update($request->all());
        return redirect(aurl('menu'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->links->isNotEmpty()) {
          return redirect(aurl('menu'))->with('error', trans('admin.please_delete_links_before'));
        }
        $menu->delete();
        return redirect(aurl('menu'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('menu'))->with('error', trans('admin.please_check_record_number'));
        }
        // destroy : it Make the Delete based on the number of request items it received
        Menu::destroy(request('items'));
        return redirect(aurl('menu'))->with('success', trans('admin.delete_success'));
    }
}
