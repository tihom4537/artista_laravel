<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistTeamInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id', 'team_name', 'phone_number','alt_phone_number', 'address','skill_category','about_team','price_per_hour','audio1','audio2','video1','video2','image1','image2','image3','image4','special_message','profile_photo'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
