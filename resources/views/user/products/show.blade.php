@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $product->name }}の詳細ページ
                    <div style="display: flex; justify-content: flex-end;">
                        <a href="{{ route('user.products.reviews.create', [$product->id]) }}" class="btn btn-success" >口コミを書く</a>
                    </div>
                </div>

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

                <div style="margin-top: 5rem;">
                    <h4 style="margin-left: 1rem;">口コミ一覧</h4>
                    <table class="table" style="width: 30rem; margin-left: 1rem;">
                        @foreach($reviews as $review) 
                        <tr>
                            <td>
                                <img src="/images/user-image.png" style="width: 5rem;">
                                <p style="font-size: 1rem;">{{ $review->user->name }}</p>
                            </td>
                            <td>
                                <div id="star_{{ $review->id }}" class="star"></div>
                                <script type="module">
                                    $('#star_{{ $review->id }}').empty();
                                    $('#star_{{ $review->id }}').raty({
                                        starOff:  '/images/star-off.png',
                                        starOn : '/images/star-on.png',
                                        starHalf: '/images/star-half.png',
                                        half: true,
                                        readOnly: true,
                                        score: '{{ $review->rate }}',
                                        size: 20,
                                    }); 
                                </script>
                                {{ $review->comment }}
                            </td>
                            @if ($review->user->id == Auth::user()->id)
                                <td>
                                    <form action="{{ route('user.products.reviews.destroy', [$product->id,$review->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input type="submit" value="削除する">
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



{{-- <script>
    window.onload = function(){
        $('#star_{{ $review->id }}').raty({
            starOff:  '/images/star-off.png',
            starOn : '/images/star-on.png',
            starHalf: '/images/star-half.png',
            half: true,
            readOnly: true,
            score: '3',
        });
    };
</script> --}}