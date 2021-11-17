@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">配送先登録 / 一覧</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('user.addresses.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                            <label for="postal_code" class="col-md-3 control-label">郵便番号<span style="font-size: 5px;">(ハイフンなし)</span></label>

                            <div class="col-md-6">
                                <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" maxlength="7" autofocus>
                                @if ($errors->has('postal_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address" class="col-md-3 control-label">住所</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" autofocus>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">宛名</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div style="text-align: center; margin-bottom: 10px;">
                            <button type="submit" class="btn btn-primary">新規登録</button>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>郵便番号</th>
                                <th>住所</th>
                                <th>宛名</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addresses as $address)
                            <tr>
                                <td>{{ $address->postal_code }}</td>
                                <td>{{ $address->address }}</td>
                                <td>{{ $address->name }}</td>
                                <td style="display: flex;">
                                    <a href="{{ route('user.addresses.edit', [$address->id]) }}" class="btn btn-success" style="margin-right: 10px;">編集する</a>
                                    <form action="{{ route('user.addresses.destroy', [$address->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input type="submit" value="削除する" class="btn btn-danger">
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
