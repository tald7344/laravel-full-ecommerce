<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\HomeBannersDatatable;
use App\Http\Controllers\Controller;
use App\Model\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HomeBannersDatatable $homeBanners)
    {
        return $homeBanners->render('admin.home-banners.index', ['title' => trans('admin.homeBannersPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home-banners.create', ['title' => trans('admin.new_banner')]);
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
            'title_ar' => 'sometimes|nullable',
            'title_en' => 'sometimes|nullable',
            'content_ar' => 'sometimes|nullable',
            'content_en' => 'sometimes|nullable',
            'image' => 'required|' . VImage()
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('image')) {
            $data['image'] = up()->upload([
                'file' => 'image',
                'path' => 'home-banners',
                'upload_type' => 'single',
                'delete_file' => ''
            ]);
        }
        HomeBanner::create($data);
        return redirect(aurl('home-banner'))->with('success', trans('admin.create_success'));
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
    public function edit(HomeBanner $homeBanner)
    {
        return view('admin.home-banners.edit', ['title' => trans('admin.edit_banner_page'), 'homeBanner' => $homeBanner]);
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
            'title_ar' => 'sometimes|nullable',
            'title_en' => 'sometimes|nullable',
            'content_ar' => 'sometimes|nullable',
            'content_en' => 'sometimes|nullable',
            'image' => 'sometimes|nullable|' . VImage()
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('image')) {
            $data['image'] = up()->upload([
                'file' => 'image',
                'path' => 'home-banners',
                'upload_type' => 'single',
                'delete_file' => HomeBanner::find($id)->image,
            ]);
        }
        HomeBanner::where('id', $id)->update($data);
        return redirect(aurl('home-banner'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeBanner $homeBanner)
    {
        Storage::delete($homeBanner->image);
        $homeBanner->delete();
        return redirect(aurl('home-banner'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('home-banner'))->with('error', trans('admin.please_check_record_number'));
        }
        foreach (request('items') as $id) {
            $homeBanners = HomeBanner::find($id);
            Storage::delete($homeBanners->image);
        }
        // destroy : it Make the Delete based on the number of request items it received
        HomeBanner::destroy(request('items'));
        return redirect(aurl('home-banner'))->with('success', trans('admin.delete_success'));
    }
}
