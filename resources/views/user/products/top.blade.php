@extends('layouts.app')

@section('content')

<div class="container" style="display: flex;">
    <div class="row" style="display: flex; flex-wrap: wrap;">
        @foreach ($products as $product)
            <div style="margin-right: 1rem;">
                <a href="{{ route('user.products.show', [$product->id]) }}" style="text-decoration: none;">
                    <img src="/storage/images/{{$product->image}}">
                    <div class="position-absolute">
                        <h5 style="color: black;">{{$product->name}}</h5>
                    </div>
                    <div class="card-body">
                        <small class="text-muted">{{$product->genre->name}}</small>
                        <div style="display: flex; justify-content: flex-end;">
                            <h4 style="color: black;">¥{{number_format($product->price)}}</h4>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div style="margin-left: auto;">
        <form method="GET" action="{{ route('user.products.top') }}">
            <div style="display: flex; margin-bottom: 1rem;">
                <input type="text" name="keyword" class="form-control" value="{{ old('keyword') }}" placeholder="キーワード検索">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </form>

        <table class="table" style="border:1px solid rgba(128, 128, 128, 0.575); width: 20rem;">
            <thead>
                <tr>
                    <th style="text-align: center;">ジャンル検索</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genres as $genre)
                    <tr>
                        <td style="border:0; text-align: center;">
                            <a href="{{ route('user.products.genre_search', [$genre->id]) }}" style="text-decoration: none; color: black;">
                                {{ $genre->name }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection