<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use App\Http\Requests\Rules\Password; // Add this line
use App\Rules\PasswordRule;

class StoreUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string' , 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password'=> ['required' , 'confirmed', new PasswordRule] // Update this line
            // 'password'=> ['required' , 'confirmed', Rules/Password::defaults()]
        ];
    }
}
