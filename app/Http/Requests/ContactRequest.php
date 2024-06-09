<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string',
                'first_name' => 'string|max:50',
                'last_name' => 'string|max:50',
                'email' => 'unique|string|max:100',
                'phone' => 'nullable|string|max:20',
                'company' => 'nullable|string|max:100',
                'position' => 'nullable|string|max:50'
        ];
    }
}
