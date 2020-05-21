@extends('layout')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('contant')
<div class="container">
    <div class="row">
        <div class="col col-md-4">
            <nav class="panel panel-default">
                <div class="panel-heading">日報作成</div>
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
                    <form action="#" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">なんか書く</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
