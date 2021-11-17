@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h2>ショッピングカート</h2>
        <form action="{{ route('user.cart_items.all_destroy') }}" method="post">
            {{ csrf_field() }}
            <input type="submit" value="カートを空にする" class="btn btn-danger">
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>数量</th>
                    <th>小計</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $sum = 0; ?>
                @foreach ($cart_items as $cart_item)
                    <tr>
                        <td>{{ $cart_item->product->name }}</td>
                        <td>{{ $cart_item->product->price }}</td>
                        <td>
                            <form method="post" action="{{ route('user.cart_items.update', [$cart_item->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}

                                <select name="amount">
                                    @foreach(range(1, 10) as $amount) 
                                        <option value="{{ $amount }}" {{old('amount', $cart_item->amount) == $amount ? 'selected' : ''}}>
                                            {{ $amount }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-success">変更</button>
                            </form>
                        </td>
                        <?php 
                            $total = ($cart_item->product->price * $cart_item->amount);
                            $sum += $total; 
                        ?>
                        <td>{{ $total }}</td>
                        <td>
                            <form action="{{ route('user.cart_items.destroy', [$cart_item->id]) }}" method="post">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="submit" value="削除する" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <p>合計金額 : {{ $sum }}</p>
        </div>
        <div>
            <a href="{{ route('user.products.top') }}" class="btn btn-primary">買い物を続ける</a>
            @if ($cart_items->isEmpty())
                <a href="{{ route('user.orders.create') }}" class="btn btn-default" style="pointer-events: none;">情報入力に進む</a>
            @else
                <a href="{{ route('user.orders.create') }}" class="btn btn-success">情報入力に進む</a>
            @endif
        </div>
    </div>
</div>
@endsection