<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InternshipStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'requirements' => 'required',
            'integration_agency' => '',
            'course_id' => 'exists:App\Models\Course,id',
            'title' => 'required|string|max:255',
            'workload' => 'required|min:0',
            'shift' => [
                'required',
                Rule::in(['day', 'afternoon', 'night']),
            ],
            'description' => 'required',
            'wage' => 'required|min:0',
            'expires_at' => 'required|date|after:now',
            'company_id' => 'exists:App\Models\Company,id',
            'address.street' => '',
            'address.number' => '',
            'address.zip_code' => '',
            'address.neighborhood' => '',
            'address.city' => '',
            'address.country' => '',
            'address.state' => '',
        ];
    }
}
