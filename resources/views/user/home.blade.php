@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">マイページ</div>

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
                    </table>
                </div>
                <div style="margin-bottom: 30px; display: flex; justify-content: center;">
                    <a href="{{ route('user.users.edit', [$user->id]) }}" class="btn btn-primary" style="margin-right: 5px;">編集する</a>
                    <form action="{{ route('user.users.destroy', [$user->id]) }}" method="post" onclick="return confirm('本当に退会しますか？')">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="submit" value="退会する" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection