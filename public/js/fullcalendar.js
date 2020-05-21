document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid'],
        //プラグイン読み込み
        defaultView: 'dayGridMonth',
        //カレンダーを月ごとに表示
        editable: true,
        //イベント編集
        firstDay: 1,
        //週の始まりを設定。1→月曜日。defaultは0(日曜日)
        eventDurationEditable: false,
        //イベントの期間変更
        selectLongPressDelay: 0,
        // スマホでタップしたとき即反応
        events: "/setEvents",
        //一旦イベントのサンプルを表示。動作確認用。

        eventDrop: function (info) {
            //eventをドラッグしたときの処理
            editEventDate(info);
            //あとで使う関数
        },

        dateClick: function (info) {
            //日付をクリックしたときの処理
            addEvent(calendar, info);
            //あとで使う関数
        },
    });
    calendar.render();
});
