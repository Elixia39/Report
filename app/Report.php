<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Report extends Model
{
    const CONDITION = [
        1 => ['label' => 'とても良い'],
        2 => ['label' => '良い'],
        3 => ['label' => '普通'],
        4 => ['label' => '悪い'],
        5 => ['label' => 'とても悪い'],
    ];

    public function getAmConditionLabelAttribute()
    {
        $condition = $this->attributes['am_condition'];

        if (!isset(self::CONDITION[$condition])) {
            return '';
        }

        return self::CONDITION[$condition]['label'];
    }

    public function getPmConditionLabelAttribute()
    {
        $condition = $this->attributes['pm_condition'];

        if (!isset(self::CONDITION[$condition])) {
            return '';
        }
        return self::CONDITION[$condition]['label'];
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['report_date'])->format('Y/m/d');
    }
}
