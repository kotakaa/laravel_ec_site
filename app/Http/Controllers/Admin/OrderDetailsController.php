<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderDetailsController extends Controller
{
    public function update(Request $request, $id)
    {
        $order = Order::find($request['order_id']);
        $order_detail = OrderDetail::find($id);
        $order_detail->making_status = $request['making_status'];
        $order_detail->save();

        foreach ($order->orderDetails as $order_detail){
            if ($order_detail->making_status == '製作中'){
                $order->status = '製作中';
                $order->save();
            }
        }

        $detail_count = $order->orderDetails->count();
        $finish_count = $order->orderDetails->where('making_status', '製作完了')
                                            ->count();
                                            
        if ($detail_count == $finish_count){
            $order->status = '発送準備中';
            $order->save();
        }

        return redirect(route('admin.orders.show', [$order->id]));
    }
}
