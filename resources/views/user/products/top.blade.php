@extends('layouts.app')

@section('content')

<div class="container" style="display: flex;">
    <div class="row" style="display: flex; flex-wrap: wrap;">
        @foreach ($products as $product)
            <div style="margin-right: 1.5rem;">
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
</div>
@endsection