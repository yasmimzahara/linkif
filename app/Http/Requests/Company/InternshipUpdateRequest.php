<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InternshipUpdateRequest extends FormRequest
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
            'requirements' => '',
            'integration_agency' => '',
            'course_id' => 'exists:App\Models\Course,id',
            'title' => 'required|string|max:255',
            'workload' => 'min:0',
            'shift' => [
                'required',
                Rule::in(['day', 'afternoon', 'night']),
            ],
            'description' => '',
            'wage' => 'min:0',
            'expires_at_date' => 'required|date',
            'expires_at_time' => 'required',
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
