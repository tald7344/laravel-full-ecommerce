<?php

use Illuminate\Support\Facades\Storage;

/*
    Admin Helper Functions
    --------------------------------------
*/

if (!function_exists('setting')) {
    function setting()
    {
        return \App\Model\Settings::orderBy('id', 'desc')->first();
    }
}

if (!function_exists('up')) {
    function up()
    {
        return new \App\Http\Controllers\Upload;
    }
}

// to load all parent departments
if (!function_exists('get_parents')) {
    function get_parents($dep_id) {
        $departement = \App\Model\Departement::find($dep_id);
        if (null !== $departement->parent && $departement->parent > 0) {
            return get_parents($departement->parent) . ', ' . $dep_id;
        } else {
            return $dep_id;
        }
    }
}


// Make Slug From Name
function make_slug($string = null, $separator = "-") {
  if (is_null($string)) {
    return "";
  }
  // Remove spaces from the beginning and from the end of the string
  $string = trim($string);
  // Lower case everything
  // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
  $string = mb_strtolower($string, "UTF-8");;
  // Make alphanumeric (removes all other characters)
  // this makes the string safe especially when used as a part of a URL
  // this keeps latin characters and arabic charactrs as well
  $string = preg_replace("/[^a-z0-9-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]_\s/u", "", $string);
  // Remove multiple dashes or whitespaces
  $string = preg_replace("/[\s-]+/", " ", $string);
  // Convert whitespaces and underscore to the given separator
  $string = preg_replace("/[\s_]/", $separator, $string);
  $string = str_replace("/", $separator, $string);
  return $string;
}


// to load all child departments
if (!function_exists('load_departements')) {
    function load_departements($select = null, $dep_id = null) {
        $departements = \App\Model\Departement::selectRaw('dep_name_' . lang() . ' as dep_name')
        ->selectRaw('id as id')
        ->selectRaw('parent as parent')
        ->selectRaw('icon as icon')
        ->get();
        // Create Departements array
        $dep_arr = [];
        foreach ($departements as $departement) {
            $list_arr = [];
            // the array key as (icon, parent, a_attr) fetch from (https://www.jstree.com/docs/json/) json format
            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['has_children'] = $departement->sons->isNotEmpty() ? true : false;
            $list_arr['children'] = [];
            // This condition is to make the departements tree opened if there is old(value) or error after submit
            if ($select !== null && $select == $departement->id) {
                $list_arr['state'] = [
                    'opened' => true,
                    'selected' => true
                ];
            }
            if ($dep_id !== null && $dep_id == $departement->id) {
                $list_arr['state'] = [
                    'opened' => false,
                    'selected' => false,
                    'disabled' => true,
                    'hidden' => true
                ];
            }
            $list_arr['id'] = $departement->id;
            $list_arr['parent'] = $departement->parent !== null ? $departement->parent : '#';
            $list_arr['text'] = $departement->dep_name;
            array_push($dep_arr, $list_arr);
        }
        return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('recording_user_daily_visit')) {
  // $model : Controller Name to find out the page that visit | 1800: in seconds which equal to 30 minutes
  function recording_user_daily_visit($controller) {
    if (!is_null(request()->getClientIp()) && !Session::has('time_delay')) {
      Session::put('time_delay', time());
      $records = \App\Model\VisitCountDaily::where('date', date('Y-m-d', time()))->get();
      if ($records->isNotEmpty()) {
        $filterRecords = $records->filter(function ($value, $key) {
          return $value->client_ip == request()->getClientIp();
        });
        if ($filterRecords->isEmpty()) {
          \App\Model\VisitCountDaily::create([
            'model' => $controller,
            'score' => 1,
            'date' => \Carbon\Carbon::now()->toDateString(),
            'client_ip' => request()->getClientIp()
          ]);
        }
      } else {
        \App\Model\VisitCountDaily::create([
          'model' => $controller,
          'score' => 1,
          'date' => \Carbon\Carbon::now()->toDateString(),
          'client_ip' => request()->getClientIp()
        ]);
      }
    }
    // delete the session after 2 hours
    if (Session::has('time_delay') && ( (time() - Session::get('time_delay')) > 7200 )  ) {
      Session::forget('time_delay');
    }
  }
}

// Get Controller Name function
if (!function_exists('get_controller_name')) {
  // Note: this function must use it inside middleware only, without it will not work because we use $request from middleware
  function get_controller_name($request)
  {
    $routeArray = $request->route()->getAction();
    if (isset($routeArray['controller'])) {
      $controllerAction = class_basename($routeArray['controller']);
      list($controller, $action) = explode('@', $controllerAction);
      return $controller;
    }
  }
}

// get user visitors per day through the month
if (!function_exists('generate_daily_visits_count')) {
  function generate_daily_visits_count($year, $month, $day) {
    $visits = \App\Model\VisitCountDaily::where('date', $year . '-' . $month . '-' . $day)->get();
    return $visits->count();
  }
}

// get user visitors per day through the month
if (!function_exists('generate_monthly_orders_count')) {
  function generate_monthly_orders_count($year, $month) {
    $visits = \App\Model\Order::select('created_at')->get();
    $visitsFilter = $visits->filter(function ($value) use ($year, $month) {
      $month = $month < 10 ? '0'.$month : $month;
      return \Carbon\Carbon::parse($value->created_at)->format('Y-m') == $year . '-' . $month;
    });
    return $visitsFilter->count();
  }
}

// helper function for url() function
if (!function_exists('aurl')) {
    // aurl(admin url) function will rewrite url function to add (admin/) route automatically to it without writed it
    function aurl($url = null)
    {
        return url('admin/' . $url);
    }
}

// admin helper function to call 'auth()->guard('admin')' guard direct
if (!function_exists('admins')) {
    function admins()
    {
        return auth()->guard('admins');
    }
}


// users helper function to call 'auth()->guard('web')' guard direct
if (!function_exists('users')) {
    function users() {
        // THis Guard fetch from 'config/auth.php' file
        return auth()->guard('web');
    }
}

if (!function_exists('calc_date')) {
  function calc_date($start, $end) {
    $endTimeStamp = strtotime($end);
    $now = time();
    $days = date("d", ($endTimeStamp - $now));
    $hours = date("H", ($endTimeStamp - $now));
    $minutes = date("i", ($endTimeStamp - $now));
    $seconds = date("s", ($endTimeStamp - $now));
    $remainTime = date("m-d H:i:s", ($endTimeStamp - $now));
    $isExpire = $endTimeStamp - $now < 0;
    return ['isExpire' => $isExpire, 'remainTime' => $remainTime, 'days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds];
  }
}

if (!function_exists('endProductHotOffer')) {
  function endProductHotOffer($id) {
    $product = \App\Model\Product::find($id);
    if (!is_null($product)) {
      $product->price_offer = NULL;
      $product->start_offer_at = NULL;
      $product->end_offer_at = NULL;
      $product->is_hot = 0;
      $product->save();
    }
  }
}

// function to check if the route is for admin or user and activate the menu for it
if (!function_exists('activate_menu')) {
    function activate_menu($link, $level = 'admin') {
        if ( $level == 'admin' ) {
            /*
                - Request::segment() = request()->segment() : it's catch the url (http://localhost:8000/admin/user)
                    and bring us (admin/user), so will be [ segment(1) == admin & segment(2) == user]
            */
            if (preg_match('/' . $link . '/i', request()->segment(2))) {
                return ['menu-open', 'active', 'display:block;'];
            } else {
                return ['', '', ''];
            }
        } else {
//          dump(count(explode('/', request()->url())) > 3);
            if (count(explode('/', request()->url())) > 3) {
              if (preg_match('#' . $link . '#i', request()->segment(1))) {
//              if (in_array(request()->segment(1), explode('/', $link))) {
                return ['active'];
              } else {
                return [''];
              }
            } else {
              if ($link == 'home') {
                return ['active'];
              } else {
                return [''];

              }
            }

        }
    }
}

// admin helper
if (!function_exists('lang')) {
    function lang() {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            session()->put('lang', setting()->default_lang);
            return setting()->default_lang;
        }
    }
}

// admin helper function for direction ltr/rtl
if (!function_exists('direction')) {
    function direction() {
        // if (session()->has('lang')) {
            if (lang() == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        // } else {
        //     return 'rtl';
        // }
    }
}

// check for image extensions
if (!function_exists('VImage')) {
    function VImage($ext = null) {
        if ($ext === null) {
            return 'image|mimes:jpg,jpeg,png,bmp,gif';
        } else {
            return 'image|mimes:' . $ext;
        }
    }
}

if (!function_exists('mall_check')) {
    function mall_check($pid, $id) {
        return \App\Model\MallProduct::where('product_id', $pid)->where('mall_id', $id)->count() > 0 ? true : false;
    }
}


if (!function_exists('words')) {
  function words($value, $words, $end = '...') {
    return \Illuminate\Support\Str::words($value, $words, $end);
  }
}

// Fetch Wishlist from database and store it into session
if (!function_exists('fetch_wishlist')) {
  function fetch_wishlist() {
    if (!session()->has('wishlist') && auth()->check()) {
      $wishlist = auth()->user()->wishlist->transform( function( $wishlist, $key) {
        return unserialize($wishlist->wishlist);
      })->first();
      if (!is_null($wishlist)) session()->put('wishlist', $wishlist);
    }
  }
}

if (!function_exists('session_time_out')) {
  function session_time_out() {
    if (Session::has('last_activity') && ( (time() - Session::get('last_activity')) > 28800 )) {
      Session::flush();
    }
    if (!Session::has('last_activity')) {
      Session::put('last_activity', time());
    }
  }
}
