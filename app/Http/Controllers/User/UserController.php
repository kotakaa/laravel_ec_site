<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        return view('user.users.edit')
            ->with('user', Auth::user());
    }

    public function update(UserRequest $request)
    {
        $user = Auth::user();

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
            return redirect(route('user.home'))
            ->with('status', 'プロフィールを変更できませんでした。');
        }
        return redirect(route('user.home'))
            ->with('status', 'プロフィールを変更しました。');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Auth::logout();

        return redirect(route('login'));
    }
}
