<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpportunityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|max:100|in:string,100',
                'close_date' => 'nullable|date'
        ];
    }
}
