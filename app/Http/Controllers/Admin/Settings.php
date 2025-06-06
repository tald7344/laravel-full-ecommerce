<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Settings as ModelSettings;
use Illuminate\Http\Request;

class Settings extends Controller
{
    public function settings()
    {
        return view('admin.settings', ['title' => trans('admin.settings')]);
    }

    public function settings_save(Request $request)
    {
        $data = $request->validate([
            'logo' => VImage(),
            'icon' => VImage(),
            'sitename_ar' => '',
            'sitename_en' => '',
            'email' => '',
            'default_lang' => '',
            'description' => '',
            'keywords' => '',
            'menu_control' => '',
            'status' => '',
            'message_maintenance' => '',
        ]);
        // Check if there is image upload on the request
        if ($request->hasFile('logo')) {

            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->logo,
            ]);
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->icon,
            ]);
        }
        ModelSettings::orderBy('id', 'desc')->update($data);
        return redirect(aurl('settings'))->with('success', trans('admin.update_success'));
    }
}
