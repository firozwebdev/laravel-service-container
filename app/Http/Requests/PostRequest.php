<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'string|max:string',
                'post_status' => 'in:Active,Inactive,Pending,Deleted',
                'description' => 'nullable'
        ];
    }
}
