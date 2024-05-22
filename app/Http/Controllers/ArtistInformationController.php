<?php

namespace App\Http\Controllers;
use App\Models\ArtistInformation;
// use Database\Factories\UserFactory;
use App\Http\Resources\ArtistInformationResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreArtistInformationRequest;
use App\Traits\HttpResponses;

use Illuminate\Http\Request;

class ArtistInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    try {
        // Attempt to retrieve all artist information
        $artists = ArtistInformation::all();
        
        // Return the retrieved artist information
        return $artists;
    } catch (\Exception $e) {
        // Handle the exception, you can log it or return an error response
        return response()->json(['error' => 'An error occurred while fetching artist information.'], 500);
    }
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtistInformationRequest $request)
    {
        $info =ArtistInformation::create([ 
            'artist_id' => Auth::guard('artist')->user()->id,
            'name'=>$request->name,
            'age'=>$request->age,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'skill_category'=>$request->skill_category,
            'skills'=>$request->skills,
            'about_yourself'=> $request->about_yourself,
            'price_per_hour'=>$request->price_per_hour,
            'audio1'=>$request->audio1,
            'audio2'=>$request->audio2,
            'video1'=>$request->video1,
            'video2'=>$request->video2,
            'image1'=>$request->image1,
            'image2'=>$request->image2,
            'image3'=>$request->image3,
            'image4'=>$request->image4,
            'special_message'=>$request->special_message,
            'profile_photo'=>$request->profile_photo,
            

        ]);
        return new ArtistInformationResource($info);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $info= ArtistInformation::where('id', $id)->first();

        return $this->isNotAuthorized($info) ? $this->isNotAuthorized($info) : new ArtistInformationResource($info);
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
        $info= ArtistInformation::where('id', $id)->first();
        if(Auth::guard('artist')->user()->id !== $info->artist_id){
            return ('You are not authorized to make request');
          }
        $info->update($request->all());

        return new ArtistInformationResource($info);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $info= ArtistInformation::where('id', $id)->first();
        $info->delete();

        return response (null,204);
    }

    private function isNotAuthorized($info){

        if(Auth::guard('artist')->user()->id !== $info->artist_id){
            return ('You are not authorized to make request ');
          }
    }

    //to fetch profile_photo,name and skills
    public function featured()
{
    try {
        // Retrieve featured artist information with selected columns
        $featuredArtists = ArtistInformation::where('featured', 1)
            ->select('id','profile_photo', 'name', 'skills','price_per_hour')
            ->get();
        
        // Return the retrieved featured artist information
        return $featuredArtists;
    } catch (\Exception $e) {
        // Handle the exception, you can log it or return an error response
        return response()->json(['error' => 'An error occurred while fetching featured artist information.'], 500);
    }
}

//to fetch all the artist of skill_category
public function getBySkillCategory($skill_category)
{
    try {
        // Retrieve artist information based on skill category
        $artists = ArtistInformation::where('skill_category', $skill_category)
            ->select('id','profile_photo', 'name', 'skills')
            ->get();
        
        // Return the retrieved artist information
        return $artists;
    } catch (\Exception $e) {
        // Handle the exception, you can log it or return an error response
        return response()->json(['error' => 'An error occurred while fetching artist information.'], 500);
    }
}

 //to fetch profile_photo,name and skills
 public function ArtistInformation($id)
 {
     try {
         // Retrieve featured artist information with selected columns
         $featuredArtists = ArtistInformation::where('id', $id)
             ->select('artist_id','profile_photo', 'name', 'skills','price_per_hour','about_yourself','image1','image2','image3','image4','special_message')
             ->get();
         
         // Return the retrieved featured artist information
         return $featuredArtists;
     } catch (\Exception $e) {
         // Handle the exception, you can log it or return an error response
         return response()->json(['error' => 'An error occurred while fetching featured artist information.'], 500);
     }
 }


}
