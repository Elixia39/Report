@extends('layout')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <nav class="panel panel-default">
                <div class="panel-heading">test作成君</div>
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
                            <label for="report_data">日付</label>
                            <input type="date" name="" id="">
                        </div>
                        <div class="form-group">
                            <label for="title">今日の体調</label><br>
                            <input class="form-control-sm" type="number" name="title" id="title" min="30" step="0.1" placeholder="今日の体温">℃<br>
                            午前の体調/午後の体調<br>
                            <select name="condition" id="condition">
                                <option value="S">とても良い</option>
                                <option value="A">良い</option>
                                <option value="B">普通</option>
                                <option value="C">悪い</option>
                                <option value="D">とても悪い</option>
                            </select>
                            <select name="condition" id="condition">
                                <option value="S">とても良い</option>
                                <option value="A">良い</option>
                                <option value="B">普通</option>
                                <option value="C">悪い</option>
                                <option value="D">とても悪い</option>
                            </select>
                            <p>
                                服薬状況<br>
                                <input class="form-control-sm" type="checkbox" name="text" id="txet">昼
                                <input class="form-control-sm" type="checkbox" name="text" id="txet">夜
                                <input class="form-control-sm" type="checkbox" name="text" id="txet">寝る前
                                <input class="form-control-sm" type="checkbox" name="text" id="txet">朝
                                <input class="form-control-sm" type="checkbox" name="text" id="txet">なし
                            </p>
                            <textarea name="" id="" cols="50" rows="5" placeholder="体調で気になること"></textarea>
                        </div>
                        本日参加のカリキュラム
                        <p>1：ラジオ体操</p>
                        <div class="form-group">
                            <label for="curriculum">2：</label>
                            <input class="form-control-sm" type="text" name="" id="" autocomplete="on" list="curriculum" placeholder="カリキュラム"><br>
                            <datalist id="curriculum">
                                <option value="事務演習">
                                <option value="JST"></option>
                                <option value="ビジネスマナー"></option>
                                <option value="就職講座"></option>
                                <option value="自主活動"></option>
                                <option value="生活学習"></option>
                                <option value="社会学習"></option>
                                <option value="SST"></option>
                                <option value="軽スポーツ"></option>
                                <option value="メンタルヘルス"></option>
                            </datalist>
                            <label for="curriculum">内容：</label>
                            <input class="form-control" type="text" name="" id="">

                        </div>
                        <div class="form-group">
                            <label for="curriculum">3：</label>
                            <input class="form-control-sm" type="text" name="" id="" placeholder="カリキュラム"><br>
                            <label for="curriculum">内容：</label>
                            <input class="form-control" type="text" name="" id="">

                        </div>

                        <div class="form-group">
                            【本日の感想】<br>
                            <textarea name="" id="" cols="50" rows="5" placeholder=""></textarea><br>

                            <label for="impression">【面談希望】（これはこのまま）</label>
                            ここに説明を追加したい
                            <p><input type="radio" name="mendan" id="">なし・<input type="radio" name="mendan" id="">あり
                                （希望日時：
                                <input type="date">
                                <input type="time">
                                面談希望です）
                            </p>

                            【そのほか連絡・相談（無くても可）】<br>
                            <textarea name="" id="" cols="50" rows="5" placeholder="おやすみの予定や手続きの進捗/報告などがあれば"></textarea><br>
                        </div>

                        <button class="btn btn-primary" type="submit">作成</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
