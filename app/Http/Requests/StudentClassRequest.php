<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Frs\LaravelMassCrudGenerator\Utils\Response;

class StudentClassRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'course_id' => 'required|integer|exists:courses,id',
			'faculty_id' => 'required|integer|exists:faculties,id',
			'semester' => 'required|string|max:20',
			'year' => 'required|integer|min:1'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->isMethod('post')) {
            // For creation failures
            $errorMessage = 'Sorry, StudentClass creation failed';
        } elseif ($this->isMethod('put')) {
            // For update failures
            $errorMessage = 'Sorry, StudentClass update failed';
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