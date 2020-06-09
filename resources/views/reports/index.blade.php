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
                <div class="panel-heading">フォルダ</div>
                <div class="panel-body">
                    <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
                        フォルダを追加する
                    </a>
                </div>
                <div class="list-group">
                    @foreach($folders as $folder)
                    <a href="{{ route('reports.index', ['id' => $folder->id]) }}" class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                        {{ $folder->title }}
                    </a>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="column col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">日報</div>
                <div class="panel-body">
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('reports.create',['id' => $current_folder_id]) }}">日報作成</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
