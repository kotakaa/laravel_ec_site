<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;

class AddressesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses =  $user->addresses()
                            ->get();
        return view('user.addresses.index')
            ->with('addresses', $addresses);
    }

    public function store(AddressRequest $request)
    {
        $user = Auth::user();

        \DB::beginTransaction();
        try{
            Address::create([
                'user_id' => $user->id,
                'name' => $request['name'],
                'postal_code' => $request['postal_code'],
                'address' => $request['address'],
            ]);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            return redirect(route('user.addresses.index'))
                ->with('status', '登録できませんでした');
        }

        return redirect(route('user.addresses.index'));
    }

    public function edit($id)
    {
        $address = Address::find($id);
        return view('user.addresses.edit')
            ->with('address', $address);
    }


    public function update(AddressRequest $request, $id)
    {
        $address = Address::find($id);
        $address->postal_code    = $request['postal_code'];
        $address->address        = $request['address'];
        $address->name           = $request['name'];
        $address->save();

        return redirect(route('user.addresses.index'))
            ->with('status', '配送先を更新しました。');
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();

        return redirect(route('user.addresses.index'))
            ->with('status', '配送先を削除しました。');
    }
}