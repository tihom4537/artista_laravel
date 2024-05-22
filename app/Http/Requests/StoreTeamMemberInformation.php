<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamMemberInformation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
               'team_id'=>['required'],
               'member_name'=>['required','max:255'],
                'email' =>['required'],
                'role'=>['required','max:255' ],
                'profile_photo'=>['nullable','max:255' ],
               
                
        ];
    }
}
