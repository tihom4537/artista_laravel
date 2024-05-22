<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistInformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>(string)$this->id,
            'attributes' =>[
                'name' =>$this->name,
                'age' =>$this->age,
                'phone_number'=>$this->phone_number,
                'address'=>$this->address,
                'skill_category'=>$this->skill_category,
                'skills'=>$this->skills,
                'about_yourself'=>$this->about_yourself,
                'profile_photo'=>$this->profile_photo,
                'price_per_hour'=>$this->price_per_hour,
                'audio1'=>$this->audio1,
                'audio2'=>$this->audio2,
                'video1'=>$this->video1, 
                'video2'=>$this->video2,          
                'image1'=>$this->image1,
                'image2'=>$this->image2,
                'image3'=>$this->image3,
                'image4'=>$this->image4,
           'special_message'=>$this->special_message,
            ],
            'relationships'=>[
            //     'id' => $this->user ? (string) $this->user->id : null,
            //     'user_name' => $this->user ? $this->user->name : null,
            //      'user_email' => $this->user ? $this->user->email : null
                // 'id'=>(string)$this->artist->id,
                // 'artist name'=>$this->artist->name,
                // 'artist email'=>$this->artist->email


            ]

        ];
    }
}
