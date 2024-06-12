<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Frs\LaravelMassCrudGenerator\Utils\Response;

class TransportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'vehicle_number' => 'required|string|max:20',
			'driver_name' => 'required|string|max:50',
			'route' => 'required|string|max:100',
			'capacity' => 'required|integer|min:1'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->isMethod('post')) {
            // For creation failures
            $errorMessage = 'Sorry, Transport creation failed';
        } elseif ($this->isMethod('put')) {
            // For update failures
            $errorMessage = 'Sorry, Transport update failed';
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