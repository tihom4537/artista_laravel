<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserInformationRequest extends FormRequest
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
            'first_name'=>['required','max:255'],
            'last_name' =>['required'],
            'phone_no' =>['required'],
            'house_no_building'=>['required','max:255' ],
            'city'=>['required','max:255' ],
            'state'=>['required','max:255' ],
            'pin'=>['required','max:255' ],
            'profile_photo'=>['nullable','max:255' ]
            
        ];
    }
}
