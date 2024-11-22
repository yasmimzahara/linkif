<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];

        if (\Auth::user()->type == 'company') {
            $rules += [
                'info.phone' => 'nullable|string',
                'info.cnpj' => 'required|string',
                'info.address.street' => '',
                'info.address.number' => '',
                'info.address.zip_code' => '',
                'info.address.neighborhood' => '',
                'info.address.city' => '',
                'info.address.country' => '',
                'info.address.state' => '',
            ];
        }

        return $rules;
    }
}
