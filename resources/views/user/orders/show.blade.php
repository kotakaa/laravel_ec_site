@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>注文履歴詳細</h1>
        <div style="display: flex; justify-content: space-between;">
            <div style="width: 40em">
                <h5>注文情報</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>注文日</th>
                        <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                    </tr>
                    <tr>
                        <th>配送先</th>
                        <td>
                            〒{{ $order->postal_code }}</br>
                            {{ $order->address }}</br>
                            {{ $order->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>支払方法</th>
                        <td>
                            @if ($order->payment_method == 'credit_card')
                                <span>クレジットカード</span>
                            @else
                                <span>銀行振込</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>ステータス</th>
                        <td>{{ $order->status }}</td>
                    </tr>
                </table>
            </div>

            <div style="width: 40em">
                <h5>請求情報</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>商品合計</th>
                        <td>{{ $order->total_payment - $order->shipping_cost }}</td>
                    </tr>
                    <tr>
                        <th>配送料</th>
                        <td>{{ $order->shipping_cost }}</td>
                    </tr>
                    <tr>
                        <th>ご請求額</th>
                        <td>{{ $order->total_payment }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div>
            <h5>注文内容</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>個数</th>
                        <th>小計</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $order_detail)
                        <tr>
                            <td>{{ $order_detail->product->name }}</td>
                            <td>{{ $order_detail->price }}</td>
                            <td>{{ $order_detail->amount }}</td>
                            <td>{{ $order_detail->price * $order_detail->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection