<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Attempt to retrieve all artist information
            $bookings = Booking::all();
            // Return the retrieved artist information
            return $bookings;
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return response()->json(['error' => 'An error occurred while fetching booking details.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // var_dump(Auth::user()->id);
        
        $booking=Booking::create([
            'user_id'=>Auth::user()->id,
            'artist_id'=>$request->artist_id,
            'booking_date'=>$request->booking_date,
            'booked_from'=>$request->booked_from,
            'booked_to'=>$request->booked_to,
            'duration'=>$request->duration,
            'location'=>$request->location,
            'special_request'=>$request->special_request

        ]);

        return ($booking);
       }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking=Booking::where('id',$id)->first();
        return $booking;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
