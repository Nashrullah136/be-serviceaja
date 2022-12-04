<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,13'],
            'password' => ['required', 'string', 'min:8'],
            'device_name' => ['required', 'string']
        ];
    }
}
