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
                <div class="panel-heading">{{ Auth::user()->name }}さん日報</div>
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
                    <form action="{{ route('reports.edit', ['folder'=>$report->folder_id,'report' => $report->id]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="report_date">日付</label>
                            <input type="date" class="form-control-sm" name="report_date" id="report_date" value="{{ old('report_date',$report->report_date) }}">
                        </div>

                        <h3>今日の体調</h3>

                        <div class="form-group">
                            <label for="temperature">今日の体温</label><br>
                            <input type="number" class="form-control-sm" name="temperature" id="temperature" min="30" step="0.1" value="{{ old('temperature',$report->temperature) }}" placeholder="今日の体温">℃
                        </div>

                        <div class="form-group">
                            <label for="am_condition">午前の体調</label><br>
                            <select name="am_condition" id="am_condition">
                                @foreach (\App\Report::CONDITION as $Key => $val)
                                <option value="{{ $Key }}" {{ $Key == old('am_condition',$report->am_condition) ? 'selected' : '' }}>{{ $val['label'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pm_condition">午後の体調</label><br>
                            <select name="pm_condition" id="pm_condition">
                                @foreach (\App\Report::CONDITION as $Key => $val)
                                <option value="{{ $Key }}" {{ $Key == old('pm_condition',$report->pm_condition) ? 'selected' : '' }}>{{ $val['label'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="medicines">服薬状況</label>
                            <p>

                                <input type="checkbox" name="medicines[]" id="medicines" value="昼" @if (Str::contains(old('medicines',$report->medicines),'昼')) checked @endif>昼
                                <input type="checkbox" name="medicines[]" id="medicines" value="夜" @if (Str::contains(old('medicines',$report->medicines),'夜')) checked @endif>夜
                                <input type="checkbox" name="medicines[]" id="medicines" value="寝る前" @if (Str::contains(old('medicines',$report->medicines),'寝る前')) checked @endif>寝る前
                                <input type="checkbox" name="medicines[]" id="medicines" value="朝" @if (Str::contains(old('medicines',$report->medicines),'朝')) checked @endif>朝
                                <input type="checkbox" name="medicines[]" id="medicines" value="なし" @if (Str::contains(old('medicines',$report->medicines),'なし')) checked @endif>なし
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="condition_report">体調で気になること</label><br>
                            <textarea name="condition_report" id="condition_report" cols="50" rows="5" placeholder="体調で気になること">{{ old('condition_report',$report->condition_report) }}</textarea>
                        </div>

                        <div class="form-group">
                            本日参加のカリキュラム
                            <p>1：ラジオ体操</p>
                            <label for="curricilum1">2：</label>
                            <input class="form-control-sm" type="text" name="curricilum1" id="curricilum1" autocomplete="on" list="curriculum" value="{{ old('curricilum1',$report->curricilum1) }}" placeholder="カリキュラム"><br>
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
                            <label for="contant1">内容：</label>
                            <input class="form-control" type="text" name="contant1" id="contant1" value="{{ old('contant1',$report->contant1) }}">
                        </div>

                        <div class="form-group">
                            <label for="curricilum2">3：</label>
                            <input class="form-control-sm" type="text" name="curricilum2" id="curricilum2" autocomplete="on" list="curriculum" value="{{ old('curricilum2',$report->curricilum2) }}" placeholder="カリキュラム"><br>
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
                            <input class="form-control" type="text" name="contant2" id="contant2" value="{{ old('contant2',$report->contant2) }}">
                        </div>

                        <div class="form-group">
                            <label for="impressions">本日の感想</label><br>
                            <textarea name="impressions" id="impressions" cols="50" rows="5">{{ old('impressions',$report->impressions) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="interview">面談希望</label>

                            <!-- <div class="form-check">
                                <input class="form-check-input" type="radio" name="check" onclick="formSwitch()" checked>
                                <label for="form-check-label">なし</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="check" onclick="formSwitch()">
                                <label for="form-check-label">あり</label>
                            </div> -->

                            <div id="interview">
                                <input type="datetime-local" name="interview" id="interview" value="{{ old('interview',$report->interview) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_information">その他連絡事項</label><br>
                            <textarea name="contact_information" id="contact_information" cols="50" rows="5">{{ old('contact_information',$report->contact_information) }}</textarea>
                        </div>

                        <button class="btn btn-primary" type="submit" onclick="return confirm('登録しますか？')" disabled>作成</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
<script>
    function formSwitch() {
hoge = document.getElementsByName('check')
if (hoge[0].checked) {
    document.getElementById('interview').style.display = "none";
    var inputItem = document.getElementById('interview').getElementsByTagName("input");
for(var i=0; i<inputItem.length;i++){
    inputItem[i].value = "";
}
} else if (hoge[1].checked) {
document.getElementById('interview').style.display = "";
}
}
window.addEventListener('load', formSwitch());
</script>
@endsection
