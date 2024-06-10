<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Frs\LaravelMassCrudGenerator\Utils\Response;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
			'first_name' => 'required|string|max:50',
			'last_name' => 'required|string|max:50',
			'email' => 'required|unique:contacts,email|string|max:100',
			'phone' => 'nullable|string|max:20',
			'company' => 'nullable|string|max:100',
			'position' => 'nullable|string|max:50'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->isMethod('post')) {
            // For creation failures
            $errorMessage = 'Sorry, Contact creation failed';
        } elseif ($this->isMethod('put')) {
            // For update failures
            $errorMessage = 'Sorry, Contact update failed';
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