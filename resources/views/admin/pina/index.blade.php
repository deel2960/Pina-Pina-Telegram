@extends('layouts.admin')
@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>トリ一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.pina.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.pina') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">鳥の名前</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-pina col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">鳥の名前</th>
                                <th width="50%">本文</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $pina)
                                <tr>
                                    <th>{{ $pina->id }}</th>
                                    <td>{{ Str::limit($pina->name, 100) }}</td>
                                    <td>{{ Str::limit($pina->body, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.pina.edit', ['id' => $pina->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.pina.delete', ['id' => $pina->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection