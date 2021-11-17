@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">会員詳細</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table table-bordered">
                        <tr>
                            <th class="width-15">名前</th>
                            <td>{{ $user->name }}</td>
                        </tr>

                        <tr>
                            <th>名前(カナ)</th>
                            <td>{{ $user->name_kana }}</td>
                        </tr>

                        <tr>
                            <th>郵便番号</th>
                            <td>〒{{ $user->postal_code }}</td>
                        </tr>

                        <tr>
                            <th>住所</th>
                            <td>{{ $user->address }}</td>
                        </tr>

                        <tr>
                            <th>メールアドレス</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>会員ステータス</th>
                            <td>
                                @if (is_null($user->deleted_at))
                                    有効
                                @else
                                    退会済み
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.users.index') }}"><< 戻る</a>
                    
                    <div style="text-align: center;">
                        <a href="{{ route('admin.users.edit', [$user->id]) }}" class="btn btn-success" style="margin-right: 5px;">編集する</a>
                        <a href="{{ route('admin.users.order', [$user->id]) }}" class="btn btn-primary">注文履歴一覧</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection