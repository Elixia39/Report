<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Calendar;
use App\Folder;
use App\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        if (Auth::check()) {
            $list = Auth::user()->holidays()->get();
            $folder = $user->folders()->first();
        } else {
            $list = Holiday::all();
            $folder = Folder::find(1);
        }

        //フォルダがなかったらフォルダ作るためのviewを用意する
        if (is_null($folder)) {
            return view('home');
        }

        $cal = new Calendar($list);
        $tag = $cal->rendarCalendar($request->month, $request->year);

        return view('calendar.index', [
            'cal_tag' => $tag,
            'folder' => $folder,
        ]);
    }

    public function getHoliday()
    {
        // 休日データ取得
        $data = new Holiday();
        $list = Auth::user()->holidays()->get();
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
            if (is_null($data)) {
                abort(404);
            }
            if (Auth::user()->id !== $data->user_id) {
                abort(403);
            }
        }
        $list = Auth::user()->holidays()->get();
        return view('calendar.holiday', [
            'list' => $list,
            'data' => $data,
        ]);
    }

    public function createHoliday(Request $request)
    {
        $validatedData = $request->validate([
            'day' => 'required',
            'description' => 'required',
        ]);

        // POSTで受信した休日データの登録
        if (isset($request->id)) {

            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            Auth::user()->holidays()->save($holiday);
        } else {
            $holiday = new Holiday();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            Auth::user()->holidays()->save($holiday);
            //$holiday->save();
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
        $list = Auth::user()->holidays()->get();
        return redirect()->route('calendar.holiday', [
            'list' => $list,
            'data' => $data,
        ]);
    }
}
