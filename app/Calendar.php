<?php

namespace App;

use Carbon\Carbon;

class Calendar
{
    private $holidays;
    private $html;
    function __construct($holidays)
    {
        $this->holidays = $holidays;
    }


    public function showCalendarTag($m, $y)
    {
        //もじゃ！
        $year = $y;
        $month = $m;

        if ($year == null) {
            // システム日付を取得する。
            $year = date("Y");
            $month = date("m");
        }

        $firstWeekDay = date("w", mktime(0, 0, 0, $month, 1, $year)); // 1日の曜日(0:日曜日、6:土曜日)
        $lastDay      = date("t", mktime(0, 0, 0, $month, 1, $year)); // 指定した月の最終日
        // 前月
        $prev = strtotime('-1 month', mktime(0, 0, 0, $month, 1, $year));
        $prev_year = date("Y", $prev);
        $prev_month = date("m", $prev);
        // 翌月
        $next = strtotime('+1 month', mktime(0, 0, 0, $month, 1, $year));
        $next_year = date("Y", $next);
        $next_month = date("m", $next);
        // 日曜日からカレンダーを表示するため前月の余った日付をループの初期値にする
        $day = 1 - $firstWeekDay;


        $this->html = <<< EOS
<h2>
<a class="btn btn-primary" href="/?year={$prev_year}&month={$prev_month}" role="button">&lt;前月</a>
{$year}年{$month}月
<a class="btn btn-primary" href="/?year={$next_year}&month={$next_month}" role="button">翌月&gt;</a>
</h2>
<table class="table table-bordered" style="table-layout:fixed;">
<tr>
  <th scope="col" class="alert alert-danger">日</th>
  <th scope="col">月</th>
  <th scope="col">火</th>
  <th scope="col">水</th>
  <th scope="col">木</th>
  <th scope="col">金</th>
  <th scope="col" class="alert alert-info">土</th>
</tr>
EOS;


        // カレンダーの日付部分を生成する
        while ($day <= $lastDay) {
            $this->html .= "<tr>";
            // 各週を描画するHTMLソースを生成する
            for ($i = 0; $i < 7; $i++) {
                if ($day <= 0 || $day > $lastDay) {
                    // 先月・来月の日付の場合
                    $this->html .= "<td>&nbsp;</td>";
                } else {
                    $this->html .= "<td>" . "<p><a href=" . "/report" . "> $day </a></p>" . "&nbsp";
                    $target = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
                    foreach ($this->holidays as $val) {
                        if ($val->day == $target) {
                            $this->html .= e($val->description);
                            break;
                        }
                    }
                    $this->html .= "</td>";
                }
                $day++;
            }
            $this->html .= "</tr>";
        }
        $this->html .= '</table>';
        return $this->html;
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

            //1日が月曜じゃない場合はcospanでその分あける
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
                $calendar .= '<td class="day" style="background-color:#008b8b">' . '<p><a href="#">' . $dt->day . '</a></p>';
                $target = date("Y-m-d", mktime(0, 0, 0, $dt->month, $dt->day, $dt->year));
                foreach ($this->holidays as $val) {
                    if ($val->day == $target) {
                        $calendar .= e($val->description);
                        break;
                    }
                }
                $calendar .= '</td>';
            } else {
                switch ($dt->format('N')) {
                    case 6:
                        $calendar .= '<td class="day" style="background-color:#b0e0e6">' . '<p><a href="#">' . $dt->day . '</a></p>' . '</td>';
                        break;
                    case 7:
                        $calendar .= '<td class="day" style="background-color:#f08080">' . '<p><a href="#">' . $dt->day . '</a></p>' . '</td>';
                        break;
                    default:
                        $calendar .= '<td class="day">' . '<p><a href="#">' . $dt->day . '</a></p>' . '&nbsp';
                        $target = date("Y-m-d", mktime(0, 0, 0, $dt->month, $dt->day, $dt->year));
                        foreach ($this->holidays as $val) {
                            if ($val->day == $target) {
                                $calendar .= e($val->description);
                                break;
                            }
                        }
                        $calendar .= '</td>';
                        break;
                }
            }
            $dt->addDay();
        }
        $calendar .= '</tr></tbody>';
        $calendar .= '</table>';

        return  $this->html . $calendar;
    }
}
