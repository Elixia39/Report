@extends('layout')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-9">
            <nav class="panel panel-default">
                <div class="panel-heading">{{ date("m") }}月分「ユーザーネーム」さん日報</div>
                <div class="panel-body">
                    {!!$cal_tag!!}
                    <a class="btn btn-primary" href="{{ route('calendar.holiday') }}">休日登録</a>
                </div>
            </nav>
        </div>

        <div class="column col-md-4">
            <nav class="panel panel-default">
                <div class="panel panel-heading">「ユーザーネーム」さん毎月分フォルダ</div>
                <div class="panel-body">
                    <a class="btn btn-default btn-block" href="{{ route('folders.create') }}">フォルダ作成</a>
                </div>
                <div class="list-group">
                    @foreach($folders as $folder)
                    <a href="{{ route('home', ['id'=>$folder->id]) }}" class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                        {{ $folder->title }}
                    </a>
                    @endforeach
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
