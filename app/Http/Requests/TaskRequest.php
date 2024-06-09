<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Frs\LaravelMassCrudGenerator\Utils\Response;

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
                'description' => '|text',
                'status' => 'in:Not Started,In Progress,Completed,Deferred',
                'due_date' => '|date'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->isMethod('post')) {
            // For creation failures
            $errorMessage = 'Sorry, Task creation failed';
        } elseif ($this->isMethod('put')) {
            // For update failures
            $errorMessage = 'Sorry, Task update failed';
        } else {
            // For other methods, use a generic error message
            $errorMessage = 'Sorry, Request failed';
        }

        // Create the custom error response
        $response = Response::badRequest(400, $errorMessage, ['message' => $validator->errors()]);

        // Throw a ValidationException with the custom error response
        throw new ValidationException($validator, $response);
    }
}