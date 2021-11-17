@extends('layouts.app')

@section('content')

<div class="container" style="display: flex;">
    <div class="row" style="display: flex; flex-wrap: wrap;">
        @foreach ($products as $product)
            <div style="margin-right: 1.5rem;">
                <a href="{{ route('admin.products.show', [$product->id]) }}" style="text-decoration: none;">
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
        @if (\Route::is('admin.products.index'))
            <a href="{{route('admin.products.selling')}}" type="button">
                <div class="btn btn-outline-primary" style="font-size: 18px; margin-left: 1rem;">販売中のみ</div>
            </a>
        @elseif (\Route::is('admin.products.selling'))
            <a href="{{route('admin.products.index')}}" type="button">
                <div class="btn btn-outline-success" style="font-size: 18px; margin-left: 1rem;">全ての商品</div>
            </a>
        @endif
    </div>
</div>
@endsection