<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CalendarEvent;
use App\Model\Mall;
use App\Model\Manufactory;
use App\Model\Order;
use App\Model\Product;
use App\Model\Review;
use App\Model\ToDo;
use App\Model\TradeMark;
use App\User;
use Carbon\Carbon;

class HomeController extends Controller {

   public function index()
   {
     $productsCount = Product::select('id')->count();
     $ordersCount = Order::select('id')->count();
     $usersCount = User::select('id')->count();
     $tradeMarksCount = TradeMark::select('id')->count();
     $mallsCount = Mall::select('id')->count();
     $manufactoriesCount = Manufactory::select('id')->count();
     $productVisit = visits('App\Model\Product')->count();
     return view('admin.home', compact('productsCount', 'ordersCount', 'usersCount', 'productVisit', 'tradeMarksCount', 'mallsCount', 'manufactoriesCount'));
   }

}
