<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    // แสดงรายการสั่งซื้อทั้งหมด
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        // $orders = Order::latest()->get();
        Log::info('Log orders :', ['orders' => $orders]);
        // dd($orders);
        return view('order-list', compact('orders'));
    }

    // แสดงรายละเอียดคำสั่งซื้อ
    public function show($user_id)
    {
        $order = Order::findOrFail($user_id);
        // dd($order);
        $orderDetails = OrderDetail::where('order_id', $user_id)->get();

        return view('order-details', compact('order', 'orderDetails'));
    }
}
