<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSetting extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'expiring_date' => 'required|integer|min:0',
            'what_time_mail_hour' => 'required|integer|between:0,23',
            'what_time_mail_minute' => 'required|integer|between:0,59',
            'how_days_mail' => 'required|integer|min:0',
        ];
    }
}
