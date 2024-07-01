<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'regex:/^[^0-9]*$/'],
            'middlename' => ['required', 'string', 'regex:/^[^0-9]*$/'],
            'lastname' => ['required', 'string', 'regex:/^[^0-9]*$/'],
            'age' => ['required', 'integer'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.regex' => 'The first Name must be letters.',
            'middlename.regex' => 'The Middle Name must be letters',
            'lastname.regex' => 'The Last Name must be letters',
            'age.integer' => 'The age must be numbers.',
        ];
    }
}
