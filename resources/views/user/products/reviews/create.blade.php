@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">レビュー作成</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('user.products.reviews.store', [$product_id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="comment">評価</label>
                            <p id="star" name="rate" class="{{ $errors->has('rate') ? 'has-error' : '' }}"></p>

                            @if ($errors->has('rate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rate') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="comment">内容</label>
                            <textarea id="comment" class="form-control {{ $errors->has('comment') ? 'has-error' : '' }}" name="comment" autocomplete="comment" autofocus>{{ old('comment') }}</textarea>
                            
                            @if ($errors->has('comment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">
                            作成する
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    window.onload = function(){
        $('#star').raty({
            starOff:  '/images/star-off.png',
            starOn : '/images/star-on.png',
            starHalf: '/images/star-half.png',
            half: true,
            scoreName: 'rate',
        });
    };
</script>