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
                <div class="panel-heading">日報登録</div>
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
                    <form action="{{ route('reports.create', ['folder'=>$folder_id]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="report_date"><span class="badge badge-danger">※</span> 日付</label>
                            <input type="date" class="form-control-sm" name="report_date" id="report_date" value="{{ old('report_date') }}">
                        </div>

                        <h3>今日の体調</h3>

                        <div class="form-group">
                            <label for="temperature">今日の体温</label><br>
                            <input type="number" class="form-control-lg" name="temperature" id="temperature" min="35" max="42" step="0.1" value="{{ old('temperature') }}" placeholder="体温">℃
                        </div>

                        <div class="form-group">
                            <label for="am_condition">午前の体調</label><br>
                            <select name="am_condition" id="am_condition">
                                @foreach (\App\Report::CONDITION as $Key => $val)
                                <option value="{{ $Key }}" {{ $Key == old('am_condition') ? 'selected' : '' }}>{{ $val['label'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pm_condition">午後の体調</label><br>
                            <select name="pm_condition" id="pm_condition">
                                @foreach (\App\Report::CONDITION as $Key => $val)
                                <option value="{{ $Key }}" {{ $Key == old('pm_condition') ? 'selected' : '' }}>{{ $val['label'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="medicines"><span class="badge badge-danger">※</span> 服薬状況</label>
                            <p>
                                <label><input type="checkbox" name="medicines[]" id="medicines" value="昼" >昼</label>
                                <input type="checkbox" name="medicines[]" id="medicines" value="夜" >夜
                                <input type="checkbox" name="medicines[]" id="medicines" value="寝る前" >寝る前
                                <input type="checkbox" name="medicines[]" id="medicines" value="朝" >朝
                                <input type="checkbox" name="medicines[]" id="medicines" value="なし" >なし
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="condition_report">体調で気になること</label><br>
                            <textarea name="condition_report" id="condition_report" cols="50" rows="5" placeholder="体調で気になること">{{ old('condition_report') }}</textarea>
                        </div>

                        <div class="form-group">
                            本日参加のカリキュラム
                            <p>1：ラジオ体操</p>
                            <label for="curricilum1"><span class="badge badge-danger">※</span> 2：</label>
                            <input class="form-control-sm" type="text" name="curricilum1" id="curricilum1" autocomplete="on" list="curriculum" value="{{ old('curricilum1') }}" placeholder="カリキュラム"><br>
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
                                <option value="も"></option>
                                <option value="軽作業"></option>
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label for="contant1">内容：</label>
                            <input class="form-control" type="text" name="contant1" id="contant1" value="{{ old('contant1') }}">
                        </div>

                        <div class="form-group">
                            <label for="curricilum2"><span class="badge badge-danger">※</span> 3：</label>
                            <input class="form-control-sm" type="text" name="curricilum2" id="curricilum2" autocomplete="on" list="curriculum" value="{{ old('curricilum2') }}" placeholder="カリキュラム"><br>
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
                        </div>

                        <div class="form-group">
                            <label for="contant2">内容：</label>
                            <input class="form-control" type="text" name="contant2" id="contant2" value="{{ old('contant2') }}">
                        </div>

                        <div class="form-group">
                            <label for="impressions">本日の感想</label><br>
                            <textarea name="impressions" id="impressions" cols="50" rows="5">{{ old('impressions') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="interview">面談希望</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="check" onclick="formSwitch()" checked>
                                <label for="form-check-label">なし</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="check" onclick="formSwitch()">
                                <label for="form-check-label">あり</label>
                            </div>

                                <input type="datetime-local" name="interview" id="interview">
                        </div>

                        <div class="form-group">
                            <label for="contact_information">その他連絡事項</label><br>
                            <textarea name="contact_information" id="contact_information" cols="50" rows="5">{{ old('contact_information') }}</textarea>
                        </div>

                        <button class="btn btn-primary" type="submit" onclick="return confirm('登録しますか？')">作成</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>

<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
    flatpickr(document.getElementById('interview'), {
    locale: 'ja',
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minTime: "10:00",
    maxTime: "17:00"
    //minDate: new Date(),
  });
</script>


<script>
    function formSwitch() {
hoge = document.getElementsByName('check')
if (hoge[0].checked) {
    document.getElementById('interview').style.display = "none";
//document.getElementById('interview').style.display = "";
var inputItem = document.getElementById('interview').getElementsByTagName("input");
for(var i=0; i<inputItem.length;i++){
    inputItem[i].value = "";
}
} else if (hoge[1].checked) {
//document.getElementById('interview').style.display = "none";
document.getElementById('interview').style.display = "";
} else {
document.getElementById('toyotaList').style.display = "none";
document.getElementById('nissanList').style.display = "none";
}
}
window.addEventListener('load', formSwitch());
</script>
@endsection
