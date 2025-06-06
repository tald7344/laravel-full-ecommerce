<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Model\Page;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
  public function index($slug)
  {
    $page = Page::where('slug', $slug)->first();
    if (is_null($page)) abort(404);
    return view('style.pages.page', compact('page'));
  }

  public function contact()
  {
    return view('style.pages.contact');
  }

  public function sendMail(Request $request)
  {
    if ($request->ajax()) {
      $validate = Validator::make($request->all(), [
          'name' => 'required|max:255',
          'email' => 'required|email',
          'subject' => 'required',
          'message' => 'required'
      ]);
      if ($validate->fails()) {
        $errors = $validate->errors();
        $txt = "<ul class='list-unstyled'>";
        if ( ! empty( $errors ) ) {
          foreach ($errors->all() as $message) {
            $txt .= '<li class="">' . $message . '</li>';
          }
        }
        $txt .= "</ul>";
        return response()->json([
          'error' => true,
          'result' => $txt,
        ]);
      } else {
        Mail::to(setting()->email)->send(new ContactUs($request->all()));
        return response()->json([
          'error' => false,
          'result' => trans('auth.contact-success-msg'),
        ]);
      }
    } else {
      abort(403 , 'Unauthorized action');
    }
  }

}
