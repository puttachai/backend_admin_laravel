<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentSlipController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('paymentslip.payment-slip-list', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->Status = $request->status;
        $order->save();

        return response()->json(['success' => true]);
        // 'message' => 'อัปเดตสถานะเรียบร้อย!']
    }
}
