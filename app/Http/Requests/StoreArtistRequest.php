<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordRule;

class StoreArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string' , 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password'=> ['required' , 'confirmed', new PasswordRule] // Update this line
            // 'password'=> ['required' , 'confirmed', Rules/Password::defaults()]
        ];
        // return [
        //     //
        // ];
    }
}
