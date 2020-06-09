<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Calendar;
use App\Folder;
use App\Holiday;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $folders = Folder::find(1);

        //フォルダがなかったらフォルダ作るためのviewを用意する
        //if文も置きます

        $list = Holiday::all();
        $cal = new Calendar($list);
        //$tag = $cal->showCalendarTag($request->month, $request->year);
        $tag = $cal->rendarCalendar($request->month, $request->year);

        return view('calendar.index', [
            'cal_tag' => $tag,
            'folders' => $folders,
        ]);
    }

    public function getHoliday()
    {
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::all();
        return view('calendar.holiday', [
            'list' => $list,
            'data' => $data,
        ]);
    }

    public function getHolidayId($id)
    {
        // 休日データ取得
        $data = new Holiday();
        if (isset($id)) {
            $data = Holiday::where('id', '=', $id)->first();
        }
        $list = Holiday::all();
        return view('calendar.holiday', [
            'list' => $list,
            'data' => $data,
        ]);
    }

    public function createHoliday(Request $request)
    {
        $validatedData = $request->validate([
            //'day' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ]);

        // POSTで受信した休日データの登録
        if (isset($request->id)) {
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->save();
        } else {
            $holiday = new Holiday();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->save();
        }
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::all();
        return redirect()->route('calendar.holiday', [
            'list' => $list,
            'data' => $data,
        ]);
    }

    public function deleteHoliday(Request $request, $id)
    {
        if (isset($request->id)) {
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->delete();
        }
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::all();
        return redirect()->route('calendar.holiday', [
            'list' => $list,
            'data' => $data,
        ]);
    }
}
