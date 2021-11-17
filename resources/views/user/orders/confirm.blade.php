@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h2>注文情報確認</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>数量</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                <?php $sum = 0; ?>
                @foreach ($cart_items as $cart_item)
                    <tr>
                        <td>
                            <img src="/storage/images/{{$cart_item->product->image}}" style="width: 50px;">
                            {{ $cart_item->product->name }}
                        </td>
                        <td>{{ $cart_item->product->price }}</td>
                        <td>{{ $cart_item->amount }}</td>
                        <?php 
                            $total = ($cart_item->product->price * $cart_item->amount);
                            $sum += $total;
                        ?>
                        <td>{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>送料{{ $order['shipping_cost'] }}</p>
        <p>商品合計{{ $sum }}</p>
        <?php
            $total_payment = ($sum + $order['shipping_cost']);
            session()->put('total_payment', $total_payment); 
        ?>
        <p>請求金額{{ $total_payment }}</p>

        <p>支払方法: 
            @if ($order['payment_method'] == 'credit_card')
                <span>クレジットカード</span>
            @else
                <span>銀行振込</span>
            @endif
        </p>
        <p>お届け先: 〒{{ $order['postal_code'].' '.$order['address'] }}</p>
        <p>{{ $order['name'] }}</p>

        <form action="{{ route('user.orders.store') }}" method="post">
            {{ csrf_field() }}
            <input type="submit" value="注文を確定する" class="btn btn-success">
        </form>
    </div>
</div>
@endsection