<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[a-zA-Z\s\-\'\.]+$/'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'not_regex:/[<>"\'\(\)&]/'
            ],
            'number' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[\+]?[0-9\-\(\)\s]+$/'
            ],
            'message' => [
                'nullable',
                'string',
                'max:2000',
                'not_regex:/<script|javascript:|data:|vbscript:|onload|onerror/i'
            ]
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name cannot exceed 100 characters.',
            'name.regex' => 'Name contains invalid characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.not_regex' => 'Email contains invalid characters.',
            'number.regex' => 'Phone number format is invalid.',
            'message.max' => 'Message cannot exceed 2000 characters.',
            'message.not_regex' => 'Message contains potentially harmful content.'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => strip_tags(trim($this->name)),
            'email' => strtolower(strip_tags(trim($this->email))),
            'number' => strip_tags(trim($this->number)),
            'message' => strip_tags(trim($this->message))
        ]);
    }
}
