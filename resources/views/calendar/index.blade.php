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
                <div class="panel-heading">
                    @if (Auth::check())
                    {{ date("m") }}月分 {{ Auth::user()->name }} さんスケジュール
                    @else
                    {{ date("m") }}月 カレンダー
                    @endif
                    
                    @if (Auth::check())
                    <a class="btn btn-primary" href="{{ route('reports.index', ['folder'=>$folder->id]) }}">日報を登録する</a>
                    <a class="btn btn-primary" href="{{ route('calendar.holiday') }}">休日を登録する</a>
                    @endif
                </div>
                <div class="panel-body">
                    {!!$cal_tag!!}
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
