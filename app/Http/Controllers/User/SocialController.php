<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service)
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('facebook_id', $user->id)->first();

            if ( !is_null($isUser) ) {
                users()->login($isUser);
                return redirect('/');
            } else {
                $createAdmin = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => bcrypt('123')
                ]);

                users()->login($createAdmin);
                return redirect('/');
            }

        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
