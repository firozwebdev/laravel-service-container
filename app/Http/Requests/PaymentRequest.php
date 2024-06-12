<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Frs\LaravelMassCrudGenerator\Utils\Response;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fee_id' => 'required|integer|exists:fees,id',
			'amount' => 'required',
			'payment_date' => 'required|date',
			'payment_method' => 'required|in:Cash,Credit Card,Bank Transfer'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->isMethod('post')) {
            // For creation failures
            $errorMessage = 'Sorry, Payment creation failed';
        } elseif ($this->isMethod('put')) {
            // For update failures
            $errorMessage = 'Sorry, Payment update failed';
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