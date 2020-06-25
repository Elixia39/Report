<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Report;
use Illuminate\Vakidation\Rule;

class EditReport extends CreateReport
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rule = parent::rules();
        return [
            //
        ];
    }
}
