@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h2>注文履歴一覧</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>注文日</th>
                    <th>配送先</th>
                    <th>注文商品</th>
                    <th>支払金額</th>
                    <th>ステータス</th>
                    <th>注文詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            〒{{ $order->postal_code }}</br>
                            {{ $order->address }}</br>
                            {{ $order->name }}
                        </td>
                        <td>
                            @foreach ($order->orderDetails as $order_detail)
                                {{ $order_detail->product->name }}</br>
                            @endforeach
                        </td>
                        <td>{{ $order->total_payment }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('user.orders.show', [$order->id]) }}" class="btn btn-primary">表示する</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection