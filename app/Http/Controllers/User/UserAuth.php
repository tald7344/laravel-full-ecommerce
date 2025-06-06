<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Mail\UserResetPassword;
use App\Model\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class UserAuth extends Controller
{
    public function login()
    {
        return view('style.auth.login');
    }

    public function doLogin()
    {
        $userValidate = $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $remember_me = request('rememberme') == 1 ? true : false;
        if (users()->attempt(['email' => request('email'), 'password' => request('password')], $remember_me)) {
            return redirect(url('/'));
        } else {
            return redirect(route('user.login'))->with('error', trans('admin.incorrect_information_login'));
        }
    }

    public function signup()
    {
        return view('style.auth.signup');
    }

    public function doSignup(UserRequest $request)
    {
      try {
        $user = User::create($request->all());
        if ($user) {
          if (users()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(url('/'))->with('success', trans('auth.register-welcome-message', ['name' => $request->name]));
          } else {
            return redirect(route('user.login'))->with('error', trans('admin.incorrect_information_login'));
          }
        }
        return redirect(route('user.login'))->with('error', trans('admin.incorrect_information_login'));
      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function profile()
    {
      $user = auth()->user();
      $orders = $user->orders;
//      $orders = Order::orderByDesc('id')->take(1)->get();
      $carts = $orders->transform( function( $cart, $key) {
        return unserialize($cart->cart);
      });

      return view('style.user.profile', compact('user', 'carts'));
    }

    public function changePassword(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'password' => 'required:min:3|confirmed',
        'password_confirmation' => 'required'
      ]);
      if ($validator->fails()) {
        return back()->withErrors($validator->errors());
      }
      $user = auth()->user();
      $user->password = $request->password;
      $user->save();
      return back()->with('success', trans('auth.password-change-message'));
    }

    public function showEditProfile()
    {
      $user = auth()->user();
      return view('style.user.edit-profile', compact('user'));
    }

    public function editProfile(Request $request)
    {
      $data = $this->validate($request, [
        'name' => 'required',
        'level' => 'required|in:user,company,vendor',
        'email' => 'required|email',
        'image' => 'sometimes|nullable|' . VImage()
      ]);
      $user = auth()->user();
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
      return redirect(url('profile'))->with('success', trans('auth.profile-edit-success'));
    }

    public function logout()
    {
        if (session()->has('wishlist')) {
          session()->forget('wishlist');
        }
        users()->logout();
        return redirect(url('/'));
    }


  public function forgot_password()
  {
    return view('style.auth.forgot_password');
  }

  public function forgot_password_post()
  {
    $user = User::where('email', request('email'))->first();
    if (!empty($user)) {
      $token = $this->createToken($user);
      Mail::to($user->email)->send(new UserResetPassword(['data' => $user, 'token' => $token]));
      session()->flash('success', trans('auth.the_link_reset_send'));
      return back();
    }
    return back()->with('error', trans('auth.email_not_exists'));
  }

  public function createToken($user)
  {
    $oldToken = DB::table('user_password_reset')->where('email', $user->email)->first();
    if ($oldToken) {
      return $oldToken->token;
    }
    $token = app('auth.password.broker')->createToken($user);
    $this->saveToken($user, $token);
    return $token;
  }

  public function saveToken($user, $token)
  {
    // Insert the data into database password_resets
    $data = DB::table('user_password_reset')->insert([
      'email' => $user->email,
      'token' => $token,
      'created_at' => Carbon::now()
    ]);
  }

  public function reset_password()
  {
    return view('style.auth.change_password');
  }

  public function change_password(ChangePasswordRequest $request, $token)
  {
    $checkToken = DB::table('user_password_reset')
      ->where('token', $token)
      ->where('created_at', '>', Carbon::now()->subHours(2))->first();

    if (!empty($checkToken)) {
      $user = User::whereEmail($checkToken->email)->first();
      $user->update(['password' => request('password')]);
      // Delete The Reset Password column With His Token
      DB::table('user_password_reset')->where('email', request('email'))->delete();
      // Login After Change Password
      users()->attempt(['email' => request('email'), 'password' => request('password')], true);
      return redirect(url('/'));
    } else {
      session()->flash('error', trans('auth.token_period_expired_time'));
      return redirect(url('forgot/password'));
    }

  }
}
