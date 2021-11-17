@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h2>注文履歴一覧</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>購入日時</th>
                    <th>購入者</th>
                    <th>注文個数</th>
                    <th>注文ステータス</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', [$order->id]) }}">
                                {{ $order->created_at->format('Y/m/d H:i') }}
                            </a>
                        </td>
                        <td>{{ $order->user->name }}</td>
                        <?php
                            $total_amount = 0;
                            foreach ($order->orderDetails as $order_detail){
                                $total_amount += $order_detail->amount;
                            }
                        ?>
                        <td>{{ $total_amount }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection