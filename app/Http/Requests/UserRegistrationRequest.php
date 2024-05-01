<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'email'=> 'required|email|unique:users',
            'name'=> 'required|max:50',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation|max:25',
            'password_confirmation' => 'min:8|max:25',
        ];
    }
}
