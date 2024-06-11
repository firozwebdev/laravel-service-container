<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Frs\LaravelMassCrudGenerator\Utils\Response;

class AssetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'asset_name' => 'required|string|max:100',
			'asset_type_id' => 'required|integer|exists:assets,id',
			'serial_number' => 'required|unique:assets,serial_number|string|max:100',
			'purchase_date' => 'required|date',
			'warranty_expiration_date' => 'nullable|date',
			'status' => 'required|in:Active,In Maintenance,Retired',
			'assigned_to' => 'nullable|integer|exists:assigneds,id',
			'location' => 'nullable|string|max:100',
			'price' => 'required|numeric|between:0,999999.99',
			'description' => 'nullable|string'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->isMethod('post')) {
            // For creation failures
            $errorMessage = 'Sorry, Asset creation failed';
        } elseif ($this->isMethod('put')) {
            // For update failures
            $errorMessage = 'Sorry, Asset update failed';
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