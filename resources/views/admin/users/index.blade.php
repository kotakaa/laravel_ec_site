@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">会員一覧</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>名前</th>
                                <th>カナ</th>
                                <th>メールアドレス</th>
                                <th>ステータス</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{ route('admin.users.show', [$user->id]) }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->name_kana }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (is_null($user->deleted_at))
                                            有効
                                        @else
                                            退会済み
                                        @endif
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
