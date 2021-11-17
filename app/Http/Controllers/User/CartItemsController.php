<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartItemRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartItemsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart_items =  $user->cartItems()
                            ->get();
        return view('user.cart_items.index')
            ->with('cart_items', $cart_items);
    }

    public function store(CartItemRequest $request)
    {
        $user = Auth::user();
        $cart_item = CartItem::where('product_id', $request['product_id'])->first();
        if (!empty($cart_item)){
            $cart_item->amount += (int)$request['amount'];
            $cart_item->save();
        }else{
            \DB::beginTransaction();
            try{
                CartItem::create([
                    'amount' => $request['amount'],
                    'user_id' => $user->id,
                    'product_id' => $request['product_id'],
                ]);
                \DB::commit();
            }catch(\Throwable $e){
                \DB::rollback();
                about(500);
            }
        }
        return redirect(route('user.cart_items.index'));
    }

    public function update(CartItemRequest $request, $id)
    {
        $cart_item = CartItem::find($id);
        $cart_item->amount = $request['amount'];
        $cart_item->save();

        return redirect(route('user.cart_items.index'));
    }

    public function destroy($id)
    {
        $cart_item = CartItem::find($id);
        $cart_item->delete();

        return redirect(route('user.cart_items.index'));
    }

    public function allDestroy()
    {
        $user = Auth::user();
        $cart_items = $user->cartItems();
        $cart_items->delete();

        return redirect(route('user.cart_items.index'));
    }
}
