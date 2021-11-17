@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ジャンルの登録</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('admin.genres.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">ジャンル名</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                    </form>
                    <table class="table table-hover" style="width: 500px; margin: 0 auto;">
                        <thead>
                            <tr>
                                <th>ジャンル</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($genres as $genre)
                            <tr>
                                <td>{{ $genre->name }}</td>
                                <td><a href="{{ route('admin.genres.edit', [$genre->id]) }}" class="btn btn-success">編集</a></td>
                                <td>
                                    <form action="{{ route('admin.genres.destroy', [$genre->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input type="submit" value="削除" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
