<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'artist_id', 'user_id','booking_date', 'booked_from', 'booked_to','location','duration','special_request'
    ];

    protected $dates = ['booking_date', 'booked_from', 'booked_to'];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
