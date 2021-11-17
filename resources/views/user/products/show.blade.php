@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $product->name }}の詳細ページ</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="display: flex;">
                        <img src="/storage/images/{{$product->image}}">
    
                        <table class="table table-bordered" style="margin-left: 1.5rem;">
                            <tr>
                                <th class="width-15">商品名</th>
                                <td>{{ $product->name }}</td>
                            </tr>
    
                            <tr>
                                <th>ジャンル</th>
                                <td>{{ $product->genre->name }}</td>
                            </tr>
    
                            <tr>
                                <th>税込価格(税抜)</th>
                                <td>￥{{ $product->price * $tax_price }}({{ $product->price }})</td>
                            </tr>
    
                            <tr>
                                <th>商品説明</th>
                                <td>{{ $product->introduction }}</td>
                            </tr>
    
                            <tr>
                                <th>販売状況</th>
                                @if ($product->is_active)
                                    <td>販売中</td>
                                @else
                                    <td>販売停止中</td>
                                @endif
                            </tr>
                        </table>
                    </div>

                    @if ($product->is_active)
                        <form method="post" action="{{ route('user.cart_items.store') }}" style="text-align: right; margin-right: 1rem;">
                            {{ csrf_field() }}
                            <select name="amount">
                                <option value="" selected="selected">選択してください</option>
                                @foreach(range(1, 10) as $number) 
                                    <option value="{{ $number }}">{{ $number }}</option>
                                @endforeach
                                <!-- range(1, 10) 始まりと終わりを指定して整数の配列を返す -->
                            </select>
                            <input name="product_id" type="hidden" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary">
                                カートに追加
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection