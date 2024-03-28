<?php

namespace App\Models;
use App\Models\UserInformation;
use Database\Factories\UserInformationFactory;
use App\Resources\UserInformationResource;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name','last_name', 'phone_no', 'house_no_building','city','state','pin','profile_photo'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
