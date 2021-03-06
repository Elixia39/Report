<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Report;
use App\Folder;
use App\User;
use App\Check;

class Calendar
{
    private $holidays;
    private $html;
    private $checks;

    function __construct($holidays)
    {
        $this->holidays = $holidays;
    }

    public function rendarCalendar($dt)
    {

        $m = (isset($_GET['m'])) ? htmlspecialchars($_GET['m'], ENT_QUOTES, 'utf-8') : '';
        $y = (isset($_GET['y'])) ? htmlspecialchars($_GET['y'], ENT_QUOTES, 'utf-8') : '';
        if ($m != null || $y != null) {
            $dt = Carbon::createFromDate($y, $m, 01);
        } else {
            $dt = Carbon::createFromDate();
        }
        //$dt = Carbon::createFromDate();

        $dt->startOfMonth();
        $dt->timezone = 'Asia/Tokyo';

        //１ヶ月前
        $sub = Carbon::createFromDate($dt->year, $dt->month, $dt->day);
        $subMonth = $sub->subMonth();
        $subY = $subMonth->year;
        $subM = $subMonth->month;

        //1ヶ月後
        $add = Carbon::createFromDate($dt->year, $dt->month, $dt->day);
        $addMonth = $add->addMonth();
        $addY = $addMonth->year;
        $addM = $addMonth->month;

        $today = Carbon::createFromDate();
        $todayY = $today->year;
        $todayM = $today->month;

        $this->html = <<<EOS
<h2>
<a class="btn btn-primary" href="/?y={$todayY}&m={$todayM}" role="button">今月</a>
{$dt->format('Y年m月')}
<a class="btn btn-primary" href="/?y={$subY}&m={$subM}" role="button">&lt;前月</a>
<a class="btn btn-primary" href="/?y={$addY}&m={$addM}" role="button">翌月&gt;</a>
</h2>
EOS;

        $headings = ['月', '火', '水', '木', '金', '土', '日',];

        $calendar = '<table class="table table-bordered" style="table-layout:fixed;">';
        $calendar .= '<thead>';
        foreach ($headings as $heading) {
            $calendar .= '<th class="header">' . $heading . '</th>';
        }
        $calendar .= '</thead>';
        $calendar .= '<tbody><tr>';


        $daysInMonth = $dt->daysInMonth;

        //ここからカレンダーの日付部分
        for ($i = 1; $i <= $daysInMonth; $i++) {

            //1日が月曜じゃない場合はcolspanでその分あける
            if ($i == 1) {
                if ($dt->format('N') != 1) {
                    $calendar .= '<td colspan=" ' . ($dt->format('N') - 1) . ' "></td>';
                }
            }

            //月曜日になったら改行
            if ($dt->format('N') == 1) {
                $calendar .= '</th><tr>';
            }
            $comp = new Carbon($dt->year . "-" . $dt->month . "-" . $dt->day);
            $comp_now = Carbon::today();

            //日付作るところ
            if ($comp->eq($comp_now)) {
                //今日の日付
                $calendar .= '<td class="day" style="background-color:#b8d200">' . '<p>' . $dt->day . '</p>';
                $target = date("Y-m-d", mktime(0, 0, 0, $dt->month, $dt->day, $dt->year));

                $checks = new Check();
                        $check = Auth::user()->checks()->get();
                        foreach ($check as $val) {
                            if ($val->day == $target) {
                                if (Auth::check()) {
                                    $calendar .= e($val->day) . "<br>";
                                    //$calendar .= $val->discription;
                                    break;
                                }
                            }
                        }
                foreach ($this->holidays as $val) {
                    if ($val->day == $target) {
                        if (Auth::check()) {
                            $calendar .= e($val->description);
                            break;
                        }
                    }
                }
                $calendar .= '</td>';
            } else {
                switch ($dt->format('N')) {
                    case 6:
                        //土曜日
                        $calendar .= '<td class="day" style="background-color:#b0e0e6">' . '<p>' . $dt->day . '</p>';
                        $target = date("Y-m-d", mktime(0, 0, 0, $dt->month, $dt->day, $dt->year));
                        foreach ($this->holidays as $val) {
                            if ($val->day == $target) {
                                if (Auth::check()) {
                                    $calendar .= e($val->description);
                                    break;
                                }
                            }
                        }
                        $calendar .= '</td>';
                        break;

                    case 7:
                        //日曜日
                        $calendar .= '<td class="day" style="background-color:#f08080">' . '<p>' . $dt->day . '</p>';
                        $target = date("Y-m-d", mktime(0, 0, 0, $dt->month, $dt->day, $dt->year));
                        foreach ($this->holidays as $val) {
                            if ($val->day == $target) {
                                if (Auth::check()) {
                                    $calendar .= e($val->description);
                                    break;
                                }
                            }
                        }
                        $calendar .= '</td>';
                        break;

                    default:
                        //その他(普通の日)
                        $calendar .= '<td class="day">' . '<p>' . $dt->day . '</p>' . '&nbsp';
                        $target = date("Y-m-d", mktime(0, 0, 0, $dt->month, $dt->day, $dt->year));

                        $checks = new Check();
                        $check = Auth::user()->checks()->get();
                        foreach ($check as $val) {
                            if ($val->day == $target) {
                                if (Auth::check()) {
                                    $calendar .= e($val->day) . "<br>";
                                    break;
                                }
                            }
                        }

                        foreach ($this->holidays as $val) {
                            if ($val->day == $target) {
                                if (Auth::check()) {
                                    $calendar .= e($val->description);
                                    break;
                                }
                            }
                        }
                        $calendar .= '</td>';
                        break;
                }
            }
            $dt->addDay();
        }


        //日付が登録されたらその日のチェックボックスにcheckを入れる
        //もしくは「入力済み」とかの文字を出す
        //予定がある日に日報は入れないはずなので大丈夫

        $calendar .= '</tr></tbody>';
        $calendar .= '</table>';

        return  $this->html . $calendar;
    }
}
