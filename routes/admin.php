<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
  * Namespace has default path (App/Http/Controllers) so any new namespace defined will add to
    default path and the new path will be as : (App/Http/Controllers/Admin)
*/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    // define the guard from 'config/auth.php' to be admin not web
    Config::set('auth.defines', 'admin');

    // group route if the user is loggedIn
    Route::group(['middleware' => 'adminGuest:admins'], function () {
        Route::get('login', 'AdminAuth@login');
        Route::post('login', 'AdminAuth@doLogin');
        Route::get('forgot/password', 'AdminAuth@forgot_password');
        Route::post('forgot/password', 'AdminAuth@forgot_password_post');
        Route::get('reset/password/{token}', 'AdminAuth@reset_password');
        Route::post('reset/password/{token}', 'AdminAuth@change_password');
    });

    // Check for middleware admin and deffined the guard as :admin | group Route If User Not Logged In
    Route::group(['middleware' => 'admin:admins'], function () {
        Route::get('/', 'HomeController@index');
        Route::any('logout', 'AdminAuth@logout');

        Route::get('calendar-event', 'CalendarController@index');
        Route::post('calendar-crud-ajax', 'CalendarController@calendarEvents');
        Route::post('calendar-delete-ajax', 'CalendarController@clearCalendarEvents');

        Route::group(['prefix' => 'to-do'], function () {
          Route::get('/', 'ToDoController@index');
          Route::get('/show', 'ToDoController@show');
          Route::post('/paginate', 'ToDoController@paginateList');
          Route::post('/add-edit', 'ToDoController@addOrEditItem');
          Route::patch('/add-edit', 'ToDoController@addOrEditItem');
          Route::post('/render-details', 'ToDoController@renderItemDetails');
          Route::patch('/checked', 'ToDoController@checkToDoItem');
          Route::delete('/delete', 'ToDoController@deleteToDoItem');
          Route::delete('/show', 'ToDoController@deleteToDoItem');
        });

        Route::resource('admin', 'AdminController');
        Route::delete('admin/destroy/all', 'AdminController@destroyAll');

        Route::resource('user', 'UserController');
        Route::delete('user/destroy/all', 'UserController@destroyAll');

        Route::resource('country', 'CountriesController');
        Route::delete('country/destroy/all', 'CountriesController@destroyAll');

        Route::resource('city', 'CitiesController');
        Route::delete('city/destroy/all', 'CitiesController@destroyAll');

        Route::resource('state', 'StatesController');
        Route::delete('state/destroy/all', 'StatesController@destroyAll');

        Route::resource('departement', 'DepartementsController');
        Route::delete('departement/destroy/all', 'DepartementsController@destroyAll');

        Route::resource('trademark', 'TradeMarksController');
        Route::delete('trademark/destroy/all', 'TradeMarksController@destroyAll');

        Route::resource('manufactory', 'ManufactoriesController');
        Route::delete('manufactory/destroy/all', 'ManufactoriesController@destroyAll');

        Route::resource('shipping', 'ShippingsController');
        Route::delete('shipping/destroy/all', 'ShippingsController@destroyAll');

        Route::resource('mall', 'MallsController');
        Route::delete('mall/destroy/all', 'MallsController@destroyAll');

        Route::resource('color', 'ColorsController');
        Route::delete('color/destroy/all', 'ColorsController@destroyAll');

        Route::resource('size', 'SizesController');
        Route::delete('size/destroy/all', 'SizesController@destroyAll');

        Route::resource('weight', 'WeightsController');
        Route::delete('weight/destroy/all', 'WeightsController@destroyAll');

        Route::resource('page', 'PagesController');
        Route::post('page/ckeditor/upload', 'PagesController@ckeditorUpload')->name('ckeditor.upload');
        Route::delete('page/destroy/all', 'PagesController@destroyAll');

        Route::resource('home-banner', 'HomeBannersController');
        Route::delete('home-banner/destroy/all', 'HomeBannersController@destroyAll');

        Route::resource('review', 'ReviewsController');
        Route::delete('review/destroy/all', 'ReviewsController@destroyAll');
        Route::post('review/approve', 'ReviewsController@approve')->name('review.approve');

        Route::resource('menu', 'MenusController');
        Route::delete('menu/destroy/all', 'MenusController@destroyAll');

        Route::resource('link', 'linksController');
        Route::delete('link/destroy/all', 'linksController@destroyAll');


        Route::get('orders', 'OrdersController@allOrders');
        Route::resource('product', 'ProductsController');
        Route::delete('product/destroy/all', 'ProductsController@destroyAll');
        Route::post('product/copy/{id}', 'ProductsController@copy_product');
        Route::post('product/search', 'ProductsController@search_product');
        Route::post('product/hot', 'ProductsController@product_hot_offer')->name('product.hot');
        Route::post('upload/image/{id}', 'ProductsController@upload_file');
        Route::post('delete/image', 'ProductsController@delete_file');
        Route::post('update/image/{id}', 'ProductsController@update_main_photo');
        Route::post('delete/main/image', 'ProductsController@delete_main_photo');
        Route::post('load/weight/size', 'ProductsController@load_weight_size');
        Route::post('ajaxGetCountryDetails', 'ProductsController@ajax_get_country_details');

        Route::get('settings', 'Settings@settings');
        Route::post('settings/save', 'Settings@settings_save');

    });

    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    });

});
