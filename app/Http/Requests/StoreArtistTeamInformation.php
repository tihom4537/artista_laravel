<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtistTeamInformation extends FormRequest
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
                'team_name'=>['required','max:255'],
                'phone_number' =>['required'],
                'alt_phone_number'=>['required'],
                'address'=>['required','max:255' ],
                'skill_category'=>['required','max:255' ],
                'about_team'=>['required','max:255' ],
                'profile_photo'=>['required','max:255' ],
                'price_per_hour'=>['required','max:255'],
                'audio1'=>['nullable','max:255' ],
                'audio2'=>['nullable','max:255' ],
                'video1'=>['nullable','max:255' ],
                'video2'=>['nullable','max:255' ],
                'image1'=>['required','max:255' ],
                'image2'=>['required','max:255' ],
                'image3'=>['required','max:255' ],
                'image4'=>['required','max:255' ],
                'special_message'=>['nullable','max:255' ],

                
            ];
    
    }
}
