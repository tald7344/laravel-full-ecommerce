<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\DataTables\UserDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDatatable $user)
    {

        return $user->render('admin.users.index', ['title' => trans('admin.userPanel')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['title' => trans('admin.new_user')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        // Check if there is image upload on the request
        if ($request->hasFile('image')) {
          $data['image'] = up()->upload([
            'file' => 'image',
            'path' => 'users',
            'upload_type' => 'single',
            'delete_file' => ''
          ]);
        }
        User::create($data);
        return redirect(aurl('user'))->with('success', trans('admin.create_success'));
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
    public function edit(User $user)
    {
        return view('admin.users.edit', ['title' => trans('admin.edit_user_page'), 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $data = $this->validate($request, [
            'name' => 'required',
            'level' => 'required|in:user,company,vendor',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'sometimes|nullable|' . VImage(),
            'password' => 'sometimes|nullable|min:3'
        ]);
        if (is_null($request->password)) {
            unset($data['password']);
        }
        // Check if there is image upload on the request
        if ($request->hasFile('image')) {
          $data['image'] = up()->upload([
            'file'          => 'image',
            'path'          => 'users',
            'upload_type'   => 'single',
            'delete_file'   => $user->image,
          ]);
        }
        $user->update($data);
        return redirect(aurl('user'))->with('success', trans('admin.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->image);
        $user->delete();
        return redirect(aurl('user'))->with('success', trans('admin.delete_success'));
    }

    public function destroyAll()
    {
        if (!request('items')) {
            return redirect(aurl('user'))->with('error', trans('admin.please_check_record_number'));
        }
        foreach (request('items') as $id) {
          $user = User::find($id);
          Storage::delete($user->image);
        }
        // destory : it Make the Delete based on the number of request items it received
        User::destroy(request('items'));
        return redirect(aurl('user'))->with('success', trans('admin.delete_success'));
    }
}
