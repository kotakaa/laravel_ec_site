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

                    <div style="margin-top: 25px; display: flex; justify-content: center;">
                        <a href="{{ route('admin.products.edit', [$product->id]) }}" class="btn btn-primary" style="margin-right: 5px;">編集する</a>
                        <form action="{{ route('admin.products.destroy', [$product->id]) }}" method="post" onclick="return confirm('本当に削除しますか？')">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="submit" value="削除する" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
