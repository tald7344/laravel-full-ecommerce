<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\TradeMarkDatatable;
use App\Model\TradeMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TradeMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarkDatatable $trademarks)
    {
        return $trademarks->render('admin.trademarks.index', ['title' => trans('admin.trademarkPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trademarks.create', ['title' => trans('admin.new_trademark')]);
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
            'trademarks_name_ar' => 'required',
            'trademarks_name_en' => 'required',            
            'logo' => 'required|' . VImage()
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => ''
            ]);
        }
        TradeMark::create($data);
        return redirect(aurl('trademark'))->with('success', trans('admin.create_success'));
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
    public function edit(TradeMark $trademark)
    {
        return view('admin.trademarks.edit', ['title' => trans('admin.edit_trademark_page'), 'trademark' => $trademark]);
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
            'trademarks_name_ar' => 'required',
            'trademarks_name_en' => 'required',
            'logo' => 'sometimes|nullable|' . VImage()
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => TradeMark::find($id)->logo,                
            ]);
        }
        TradeMark::where('id', $id)->update($data);
        return redirect(aurl('trademark'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TradeMark $trademark)
    {
        Storage::delete($trademark->logo);
        $trademark->delete();
        return redirect(aurl('trademark'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('trademark'))->with('error', trans('admin.please_check_record_number'));
        }
        foreach (request('items') as $id) {
            $trademarks = TradeMark::find($id);
            Storage::delete($trademarks->logo);
        }
        // destory : it Make the Delete based on the number of request items it received
        TradeMark::destroy(request('items'));
        return redirect(aurl('trademark'))->with('success', trans('admin.delete_success'));
    }
}
