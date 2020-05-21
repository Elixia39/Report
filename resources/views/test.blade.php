@extends('layout')

@section('styles')
<link href='/css/fullcalendar/core/main.css' type="text/css" rel='stylesheet' />
<link href='/css/fullcalendar/daygrid/main.css' type="text/css" rel='stylesheet' />
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col col-md-8">
            <nav class="panel panel-default">
                <div class="panel-heading">ぽ</div>
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
                    <div id="calendar"></div>
                </div>
            </nav>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src='/js/fullcalendar/core/main.js'></script>
<script src='/js/fullcalendar/daygrid/main.js'></script>
<script src='/js/fullcalendar/interaction/main.js'></script>

<script src='/js/ajax-setup.js'></script>
<script src='/js/fullcalendar.js'></script>
<script src='/js/event-control.js'></script>
@endsection
