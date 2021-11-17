<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->get(); //withTrashed() で退会済みも含む
        return view('admin.users.index')
            ->with('users', $users);
    }

    public function show($id)
    {
        $user = User::withTrashed()->find($id);
        return view('admin.users.show')
            ->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::withTrashed()->find($id);
        return view('admin.users.edit')
            ->with('user', $user);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::withTrashed()->find($id);

        \DB::beginTransaction();
        try{
            $user->name = $request['name'];
            $user->name_kana = $request['name_kana'];
            $user->email = $request['email'];
            $user->postal_code = $request['postal_code'];
            $user->address = $request['address'];
            $user->save();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            return redirect(route('admin.users.show', [$user->id]))
            ->with('status', 'プロフィールを変更できませんでした。');
        }
        return redirect(route('admin.users.show', [$user->id]))
            ->with('status', 'プロフィールを変更しました。');
    }

    public function order($id)
    {
        $user = User::withTrashed()->find($id);
        $orders = $user->orders;
        return view('admin.orders.index')
            ->with('orders', $orders);
    }
}
