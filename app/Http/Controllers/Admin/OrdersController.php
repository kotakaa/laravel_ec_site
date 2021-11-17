<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index')
            ->with('orders', $orders);
    }

    public function show($id)
    {
        $order = Order::find($id);
        $order_status = Order::STATUS;
        $making_status = OrderDetail::STATUS;
        return view('admin.orders.show')
            ->with('order_status', $order_status)
            ->with('making_status', $making_status)
            ->with('order', $order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request['status'];
        $order->save();

        if ($order->status == '入金確認'){
            foreach ($order->orderDetails as $order_detail){
                $order_detail->making_status = '製作待ち';
                $order_detail->save();
            }
        }

        return redirect(route('admin.orders.show', [$order->id]));
    }
}
