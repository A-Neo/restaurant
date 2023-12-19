<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|regex:/[0-9]{10}/'
        ];
    }

}
