<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReport extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'report_date' => 'required',
            'curricilum1' => 'required|max:25',
            'curricilum2' => 'required|max:25',
            'medicines' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'report_date' => '日付',
            'curricilum1' => 'カリキュラム2',
            'curricilum2' => 'カリキュラム3',
            'medicines' => '服薬状況',
        ];
    }
}
