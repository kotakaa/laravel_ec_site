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
                        <th>購入者</th>
                        <td>{{ $order->user->name }}</td>
                    </tr>
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
                        <th>注文ステータス</th>
                        <td>
                            <form method="post" action="{{ route('admin.orders.update', [$order->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}

                                <select name="status">
                                    @foreach($order_status as $status) 
                                        <option value="{{ $status }}" {{old('status', $order->status) == $status ? 'selected' : ''}}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-success">更新</button>
                            </form>
                        </td>
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
                        <th>請求金額</th>
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
                        <th>製作ステータス</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $order_detail)
                        <tr>
                            <td>{{ $order_detail->product->name }}</td>
                            <td>{{ $order_detail->price }}</td>
                            <td>{{ $order_detail->amount }}</td>
                            <td>{{ $order_detail->price * $order_detail->amount }}</td>
                            <td>
                                <form method="post" action="{{ route('admin.order_details.update', [$order_detail->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
    
                                    <select name="making_status">
                                        @foreach($making_status as $status) 
                                            <option value="{{ $status }}" {{old('status', $order_detail->making_status) == $status ? 'selected' : ''}}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input name="order_id" type="hidden" value="{{ $order->id }}">
                                    <button type="submit" class="btn btn-success">更新</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection