<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email:rfc,dns',
                Rule::unique('users')->ignore($this->company->id),
            ],
            'info.phone' => 'nullable|string',
            'info.cnpj' => 'required|string|size:14',
            'info.address.street' => '',
            'info.address.number' => '',
            'info.address.zip_code' => '',
            'info.address.neighborhood' => '',
            'info.address.city' => '',
            'info.address.country' => '',
            'info.address.state' => '',
        ];
    }
}
