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
                <div class="panel-heading">フォルダ | <a href="{{ route('home') }}">スケジュール画面へ</a></div>
                <div class="panel-body">
                    <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
                        フォルダを追加する
                    </a>
                </div>
                <div class="list-group">
                    @foreach($folders as $folder)
                    <a href="{{ route('reports.index', ['folder' => $folder->id]) }}" class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">
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
                        <a class="btn btn-default btn-block" href="{{ route('reports.create',['folder' => $current_folder_id]) }}">日報を作成する</a>
                    </div>
                </div>
                <table class="table" style="table-layout: fixed">
                    <thead>
                        <tr>
                            <th>日付</th>
                            <th>午前のカリキュラム</th>
                            <th>午後のカリキュラム</th>
                            <th>編集</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr>
                            <td><span>{{ $report->report_date }}</span></td>
                            <td>{{ $report->curricilum1 }}</td>
                            <td>{{ $report->curricilum2 }}</td>
                            <td><a href="{{ route('reports.edit', ['folder'=>$report->folder_id,'report'=>$report->id]) }}">編集</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
