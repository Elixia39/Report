@extends('layout')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-4">
            <nav class="panel panel-default">
                <div class="panel-heading">休日設定：<a href="{{ route('home') }}" class="btn btn-primary">カレンダーに戻る</a></div>
                <div class="panel-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('calendar.holiday') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="day">日村</label>
                            <input class="form-control" type="text" name="day" id="day" value="{{ old('day') }}">
                            <label for="description">説明</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description') }}">
                        </div>
                        <button class="btn btn-primary" type="submit" onclick="return confirm('登録しますか？')">登録</button>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                    </form>
                </div>
            </nav>
        </div>
        <div class="column col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">予定</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>説明</th>
                                <th>作成日</th>
                                <th>更新日</th>
                                <th>削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                            <tr>
                                <td><a href="{{ route('calendar.edit',['id' => $item->id]) }}" onclick="return confirm('この予定を更新しますか？')">{{ $item->day }}</a></td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <form action="{{ route('delete.holiday', ['id'=>$item->id]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-default" type="submit" onclick="return confirm('削除しますか？')">削除</button>
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

@section('scripts')
@include('share.flatpickr.scripts')
@endsection
