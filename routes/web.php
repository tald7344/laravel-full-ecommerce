<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('callback/{service}', 'User\SocialController@callback');
Route::get('/config-cache', function() {
  Artisan::call('config:cache');
  Artisan::call('cache:clear');
 return '<h1>Clear Config and cache cleared</h1>';
});

Route::group(['middleware' => 'maintenance', 'namespace' => 'User'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('shop/view/{product_id}', 'ShopProductsController@show');
    Route::get('shop/{sort}/{category_id?}', 'ShopProductsController@index');
    Route::post('shop/ajax-new-review', 'ShopProductsController@ajax_new_review');
    Route::resource('shop', 'ShopProductsController');
    Route::post('ajax-filter-product', 'ShopProductsController@ajaxFilterProducts');
    Route::post('add-to-cart/{id}', 'ShopProductsController@addToCart');
    Route::get('cart', 'ShopProductsController@shoppingCarts');
    Route::get('empty-cart', 'ShopProductsController@emptyCart');
    Route::delete('remove-cart/{id}', 'ShopProductsController@destroy')->name('cart.destroy');
    Route::put('update-cart/{id}', 'ShopProductsController@update')->name('cart.update');
    Route::post('search', 'ShopProductsController@search')->name('product.search');
    Route::get('contact', 'PagesController@contact');
    Route::post('contact', 'PagesController@sendMail')->name('contact.send');
    Route::get('page/{slug}', 'PagesController@index');
    Route::post('add-to-wishlist/{id}', 'ShopProductsController@addToWishlist');

    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', 'UserAuth@login')->name('user.login');
        Route::post('login', 'UserAuth@doLogin')->name('user.doLogin');
        Route::get('signup', 'UserAuth@signup')->name('user.signup');
        Route::post('signup', 'UserAuth@doSignup')->name('user.doSignup');
        Route::get('forgot/password', 'UserAuth@forgot_password');
        Route::post('forgot/password', 'UserAuth@forgot_password_post');
        Route::get('reset/password/{token}', 'UserAuth@reset_password');
        Route::post('reset/password/{token}', 'UserAuth@change_password');
        Route::get('redirect/{service}', 'SocialController@redirect');
    });

    // prevent user to access these routes if not logged In
    Route::group(['middleware' => 'auth'], function () {
        Route::any('logout', 'UserAuth@logout')->name('user.logout');
        Route::get('profile', 'UserAuth@profile')->name('user.profile');
        Route::get('profile/edit', 'UserAuth@showEditProfile');
        Route::put('profile/edit', 'UserAuth@editProfile')->name('user.editProfile');
        Route::put('change-password', 'UserAuth@changePassword')->name('user.changePassword');
        Route::get('checkout', 'ShopProductsController@checkout');
        Route::post('charge', 'ShopProductsController@charge');
        Route::get('order', 'OrderController@index')->name('order.index');
        Route::get('wishlist', 'ShopProductsController@wishlist');
        Route::get('empty-wishlist', 'ShopProductsController@emptyWishlist');
        Route::delete('remove-wishlist/{id}', 'ShopProductsController@removeWishlistItem')->name('wishlist.destroy');
    });


  Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang') : '';
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
    return back();
  })->name('change-lang');

});

Route::get('maintenance', function () {
    if (setting()->status == 'open') {
        return redirect('/');
    }
    return view('style.maintenance');
});

