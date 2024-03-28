<?php

namespace App\Http\Resources;
// use App\Resources\UserInformationResource;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\UserInformation;

class UserInformationResource extends JsonResource
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
                'first_name' =>$this->first_name,
                'last_name' =>$this->last_name,
                'phone_no'=>$this->phone_no,
                'house_no_building'=>$this->house_no_building,
                'city'=>$this->city,
                'state'=>$this->state,
                'pin'=>$this->pin,
                'profile_photo'=>$this->profile_photo
            ],
            'relationships'=>[
            //     'id' => $this->user ? (string) $this->user->id : null,
            //     'user_name' => $this->user ? $this->user->name : null,
            //      'user_email' => $this->user ? $this->user->email : null
                'id'=>(string)$this->user->id,
                'user name'=>$this->user->name,
                'user email'=>$this->user->email


            ]

        ];
    }
}
