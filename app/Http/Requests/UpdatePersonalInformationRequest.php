<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInformationRequest extends FormRequest
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
            'age' => ['required', 'integer', 'min:10'],
            'gender' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required',  'string'],
            'employement_status' => ['required',  'string'],
            'degree_level' => ['required',  'string'],
        ];
    }
}
