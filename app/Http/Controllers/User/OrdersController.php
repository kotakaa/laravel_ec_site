<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetail;

class OrdersController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders =  $user->orders()
                            ->get();
        return view('user.orders.index')
            ->with('orders', $orders);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('user.orders.show')
            ->with('order', $order);
    }

    public function create()
    {
        $user = Auth::user();
        $addresses =  $user->addresses()
                            ->get();
        return view('user.orders.create')
            ->with('user', $user)
            ->with('addresses', $addresses);
    }

    public function confirm(OrderRequest $request)
    {
        $user = Auth::user();
        $cart_items =  $user->cartItems()
                            ->get();

        session()->put('payment_method', $request['payment_method']);
        session()->put('user_id', $user->id);
        session()->put('shipping_cost', 800);

        if ($request['address_type'] == '0'){
            session()->put('name', $user->name);
            session()->put('postal_code', $user->postal_code);
            session()->put('address', $user->address);

        }else if ($request['address_type'] == '1'){
            $address = Address::find($request['address_id']);
            session()->put('name', $address->name);
            session()->put('postal_code', $address->postal_code);
            session()->put('address', $address->address);

        }else if ($request['address_type'] == '2'){
            session()->put('name', $request['name']);
            session()->put('postal_code', $request['postal_code']);
            session()->put('address', $request['address']);
        }
        $order = session()->all();

        return view('user.orders.confirm')
            ->with('cart_items', $cart_items)
            ->with('order', $order);
    }

    public function store()
    {
        $user = Auth::user();
        $order = new Order(session()->all());
        \DB::beginTransaction();
        try{
            $order->save();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            return redirect(route('user.orders.confirm'))
                ->with('status', '注文できませんでした');
        }

        $cart = $user->cartItems();
        $cart_items = $cart->get();
        foreach ($cart_items as $cart_item){
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $cart_item->product_id;
            $order_detail->price = $cart_item->product->price;
            $order_detail->amount = $cart_item->amount;
            $order_detail->save();
        }

        $cart->delete();

        return redirect(route('user.orders.thanks'));
    }

    public function thanks()
    {
        return view('user.orders.thanks');
    }
}
