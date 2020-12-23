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
                <div class="panel-heading">{{ Auth::user()->name }}さん 予定</div>
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
                            <label for="day">予定の日付</label>
                            <input class="form-control" type="text" name="day" id="day" value="{{ old('day',$holiday->day) }}"><br>
                            <label for="description">説明</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description',$holiday->description) }}">
                        </div>
                        <button class="btn btn-primary" type="submit" onclick="return confirm('登録しますか？')" disabled>登録</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('share.flatpickr.scripts')
@endsection
