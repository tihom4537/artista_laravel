<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMemberInformation extends Model
{
    use HasFactory;

    protected $fillable =[
        'team_id','member_name','email','profile_photo','role'

    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
