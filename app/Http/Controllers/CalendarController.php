<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Calendar;
use App\Folder;
use App\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostMail;
use App\User;
use App\Report;

class CalendarController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        $report = new Report();

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

        $reports = $folder->reports()->get();

        $cal = new Calendar($list,$report);
        $tag = $cal->rendarCalendar($request->month, $request->year);

        return view('calendar.index', [
            'cal_tag' => $tag,
            'folder' => $folder,
            //'reports' => $reports,
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

            $to = array('ここにめあど');
            Mail::to($to)->send(new PostMail($holiday));
        } else {
            $holiday = new Holiday();
            $holiday->day = $request->day;
            $holiday->description = $request->description;

            Auth::user()->holidays()->save($holiday);

            $to = array('ここにめあど');
            Mail::to($to)->send(new PostMail($holiday));
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

            //ここにメールの記述
            //削除時に別のメソッド用意するのがめんどくさい(メールとして受け取る必要性があまり感じない)
            //個別で該当するメールを消すか、メーラーを作成するかになる
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
