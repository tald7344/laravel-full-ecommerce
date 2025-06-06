<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\PageDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Model\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageDatatable $pages)
    {
        return $pages->render('admin.pages.index', ['title' => trans('admin.pagePanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create', ['title' => trans('admin.new_page')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
      try {
        $data = $request->all();
        $slug = make_slug($request->name_en);
        $data['slug'] = $slug;
        Page::create($data);
        return redirect(aurl('page'))->with('success', trans('admin.create_success'));
      } catch (\Exception $e) {
        return $e->getMessage();
      }
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
    public function edit(Page $page)
    {
        return view('admin.pages.edit', ['title' => trans('admin.edit_page_page'), 'page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        try {
          $data = $request->all();
          $slug = make_slug($request->name_en);
          $data['slug'] = $slug;
          $page->update($data);
          return redirect(aurl('page'))->with('success', trans('admin.update_success'));
        } catch (\Exception $e) {
          return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
      try {
        $page->delete();
        return redirect(aurl('page'))->with('success', trans('admin.delete_success'));
      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('page'))->with('error', trans('admin.please_check_record_number'));
        }
        // destory : it Make the Delete based on the number of request items it received
        Page::destroy(request('items'));
        return redirect(aurl('page'))->with('success', trans('admin.delete_success'));
    }

    public function ckeditorUpload(Request $request)
    {
      if($request->hasFile('upload')) {
        $fileName = up()->upload([
          'file' => 'upload',
          'path' => 'ckeditor_images',
          'upload_type' => 'single',
          'delete_file' => ''
        ]);
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = Storage::url($fileName);
        $msg = trans('admin.image-uploaded-success');
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
      }
    }
}
