<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Frs\LaravelMassCrudGenerator\Utils\Response;

class StudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
			'first_name' => 'required|string|max:50',
			'last_name' => 'required|string|max:50',
			'dob' => 'required|date',
			'gender' => 'required|in:Male,Female,Other',
			'address' => 'nullable|string',
			'city' => 'nullable|string|max:50',
			'state' => 'nullable|string|max:50',
			'zip_code' => 'nullable|string|max:20',
			'enrollment_date' => 'required|date',
			'department_id' => 'required|integer|exists:departments,id',
			'program_id' => 'required|integer|exists:programs,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->isMethod('post')) {
            // For creation failures
            $errorMessage = 'Sorry, Student creation failed';
        } elseif ($this->isMethod('put')) {
            // For update failures
            $errorMessage = 'Sorry, Student update failed';
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