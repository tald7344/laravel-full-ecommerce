<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
  public function allOrders()
  {
    $title = trans('admin.orders');
    $orders = Order::orderByDesc('id')->paginate(10);
    $carts = $orders->transform(function ($cart, $key) {
      return ['cart' => unserialize($cart->cart), 'user_id' => $cart->user_id];
    });
    return view('admin.orders.index', compact('title', 'orders', 'carts'));
  }
}
