@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2 bg-white">
            <div class="font-weight-bold text-center border-bottom" style="font-size: 24px">注文情報入力</div>
            <form method="post" action="{{ route('user.orders.confirm') }}">
                {{ csrf_field() }}
    
                <h4>支払方法</h4>
    
                <div class="form-group">
                    <label for="payment_method">支払方法</label>
    
                    <label><input type="radio" value="credit_card" name="payment_method" 　checked="" @if (old('payment_method') == "credit_card") checked @endif>クレジットカード</label>
                    <label><input type="radio" value="bank_transfer" name="payment_method" @if (old('payment_method') == "bank_transfer") checked @endif>銀行振込</label> 
                </div>
    
    
                <h4>お届け先</h4>
    
                <div class="form-group">
                <label><input type="radio" value="0" name="address_type" @if (old('address_type') == 0) checked @endif>ご自身の住所</label>
                    <div class="form-group mt-3">
                        <p>〒 {{ $user->postal_code.' '.$user->address }}</p>
                        <p>{{ $user->name }}</p>
                    </div>
                </div>
    
                <label><input type="radio" value="1" name="address_type" @if (old('address_type') == 1) checked @endif>登録済住所から選択</label>
                    <div class="form-group mt-3">
                        <select name="address_id" class="custom-select {{ $errors->has('address_id') ? 'has-error' : '' }}">
                            <option value="" selected="selected">選択してください</option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" {{old('address_id') == $address->id ? 'selected' : ''}}>
                                    〒 {{ $address->postal_code.' '.$address->address.' '.$address->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('address_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address_id') }}</strong>
                            </span>
                        @endif
                    </div>
    
                <label><input type="radio" value="2" name="address_type" @if (old('address_type') == 2) checked @endif>新しいお届け先</label>
                    <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                        <label for="postal_code" class="control-label">郵便番号<span style="font-size: 5px;">(ハイフンなし)</span></label>

                        <input id="postal_code" type="text" name="postal_code" value="{{ old('postal_code') }}" maxlength="7" autofocus>
                        @if ($errors->has('postal_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('postal_code') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="address" class="control-label">住所</label>
                        
                        <input id="address" type="text" name="address" value="{{ old('address') }}" autofocus>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="control-label">宛名</label>
                        
                        <input id="name" type="name" name="name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
    
                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-primary">
                        確認画面へ進む
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection