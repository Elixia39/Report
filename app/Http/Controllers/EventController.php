<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function setEvents(Request $request)
    {
        $start = $this->formatDate($request->all()['start']);
        $end = $this->formatDate($request->all()['end']);

        $events = Event::select('id', 'title', 'date')->whereBetween('date', [$start, $end])->get();

        $newArr = [];
        foreach ($events as $item) {
            $newItem["id"] = $item["event_id"];
            $newItem["title"] = $item["title"];
            $newItem["start"] = $item["date"];
            $newArr[] = $newItem;
        }

        echo json_encode($newArr);
        //json形式にして出力
    }

    public function formatDate($date)
    {
        return str_replace('T00:00:00+09:00', '', $date);
        // "2019-12-12T00:00:00+09:00"のようなデータを"2019-12-12"に整形
    }

    public function addEvent(Request $request)
    {
        $data = $request->all();
        $event = new Event();
        $event->event_id = $this->generateId();
        $event->date = $data['date'];
        $event->title = $data['title'];
        $event->save();

        return response()->json(['event_id' => $event->event_id]);
    }
    // ajaxで受け取ったデータをデータベースに追加し、今度はidを返す。

    public function editEventDate(Request $request)
    {
        $data = $request->all();
        $event = Event::find($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;
    }
    // ajaxで受け取ったデータからデータベースの日付データを変更。

}
