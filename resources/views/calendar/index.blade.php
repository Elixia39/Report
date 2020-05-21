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
                    <a class="btn btn-primary" href="{{ action('ReportController@index',['id' => $folders->id]) }}">日報一覧</a>
                    <a class="btn" href="/test/report">実験用</a>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
