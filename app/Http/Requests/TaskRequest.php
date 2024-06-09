<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|max:100',
                'description' => 'nullable',
                'due_date' => 'nullable|date',
                'assigned_to' => 'nullable'
        ];
    }
}
