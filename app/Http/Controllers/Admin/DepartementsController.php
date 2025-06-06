<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\DepartementsRequest;
use App\Model\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.departements.index', ['title' => trans('admin.departementPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departements.create', ['title' => trans('admin.new_departement')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartementsRequest $request)
    {
        $data = $this->validate($request, [
            'dep_name_ar' => 'required',
            'dep_name_en' => 'required',
            'description' => 'sometimes|nullable|max:180',
            'keywords' => 'sometimes|nullable',
            'parent' => 'sometimes|nullable',
            'icon' => 'sometimes|nullable|' . VImage()
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'departements',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        Departement::create($data);
        return redirect(aurl('departement'))->with('success', trans('admin.create_success'));
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
    public function edit(Departement $departement)
    {
        return view('admin.departements.edit', ['title' => trans('admin.edit_departement_page'), 'departement' => $departement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement)
    {
        $data = $this->validate($request, [
            'dep_name_ar' => 'required',
            'dep_name_en' => 'required',
            'description' => 'sometimes|nullable',
            'keywords' => 'sometimes|nullable',
            'parent' => 'sometimes|nullable',
            'icon' => 'sometimes|nullable|' . VImage()
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'departements',
                'upload_type' => 'single',
                'delete_file' => $departement->icon,
            ]);
        }
        $departement->update($data);
        return redirect(aurl('departement'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_parent($id);
        return redirect(aurl('departement'))->with('success', trans('admin.delete_success'));
    }

    public static function delete_parent($id)
    {
        $departements = Departement::where('parent', $id)->get();
        foreach($departements as $sub) {
            // to delete the sub department that could be in every $sub
            self::delete_parent($sub->id);
            // Check if the department has icon
            if (!empty($sub->icon)) {
                Storage::has($sub->icon) ? Storage::delete($sub->icon) : '';
            }
            // Check for department that has sub department
            $departement = Departement::find($sub->id);
            if (!empty($departement)) {
                $departement->delete();
            }
        }
        $currentDepartement = Departement::find($id);
        if (!empty($currentDepartement->id)) {
            if (!empty($currentDepartement->icon)) {
                Storage::has($currentDepartement->icon) ? Storage::delete($currentDepartement->icon) : '';
            }
            $currentDepartement->delete();
        }
    }

}
