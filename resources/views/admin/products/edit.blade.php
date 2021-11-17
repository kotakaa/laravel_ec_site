@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2 bg-white">

        <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">商品を編集する</div>
        <form method="post" action="{{ route('admin.products.update', [$product->id]) }}" class="p-5" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div>商品の画像</div>
            <span class="item-image-form image-picker">
                <input type="file" name="image" style="display: none;" accept="image/png,image/jpeg,image/gif" id="image" class="{{ $errors->has('image') ? 'has-error' : '' }}" value="{{ old('image', $product->image) }}"/>
                <label for="image" class="d-inline-block" role="button">
                    <img id="preview" src="/storage/images/{{$product->image}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                </label>

                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </span>

            <div class="form-group mt-3">
                <label for="name">商品名</label>
                <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" value="{{ old('name', $product->name) }}" autocomplete="name" autofocus>
                
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form-group mt-3">
                <label for="introduction">商品の説明</label>
                <textarea id="introduction" class="form-control {{ $errors->has('introduction') ? 'has-error' : '' }}" name="introduction" autocomplete="introduction" autofocus>{{ old('introduction', $product->introduction) }}</textarea>
                
                @if ($errors->has('introduction'))
                    <span class="help-block">
                        <strong>{{ $errors->first('introduction') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group mt-3">
                <label for="">ジャンル</label>

                <select name="genre" class="custom-select {{ $errors->has('genre') ? 'has-error' : '' }}">
                    <option value="" selected="selected">選択してください</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{old('genre', $product->genre->id) == $genre->id ? 'selected' : ''}}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('genre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('genre') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group mt-3">
                <label for="price">価格</label>
                <input id="price" type="number" class="form-control {{ $errors->has('price') ? 'has-error' : '' }}" name="price" value="{{ old('price', $product->price) }}" autocomplete="price" autofocus>
                
                @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group mt-3">
                <label for="is_active">販売ステータス</label>

                <label><input type="radio" value="1" name="is_active" @if (old('is_active', $product->is_active) == 1) checked @endif>販売する</label>
                <label><input type="radio" value="0" name="is_active" @if (old('is_active', $product->is_active) == 0) checked @endif>販売を停止にする</label> 
            </div>

            <div class="form-group mb-0 mt-3">
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
window.onload = function(){
    $("[name='image']").on('change', function (e) {
    var reader = new FileReader();
    
    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
    });
};
</script>
@endsection