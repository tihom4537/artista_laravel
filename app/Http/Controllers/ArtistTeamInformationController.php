<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtistTeamInformation;
use App\Http\Requests\StoreArtistTeamInformation;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ArtistTeamInformationResource;

class ArtistTeamInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // try {
            // Attempt to retrieve all artist information
            $artists = ArtistTeamInformation::all();
            
            // Return the retrieved artist information
            return $artists;
        // } catch (\Exception $e) {
        //     // Handle the exception, you can log it or return an error response
        //     return response()->json(['error' => 'An error occurred while fetching artist information.'], 500);
        // }
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
    public function store(StoreArtistTeamInformation $request)
    {
        $info =ArtistTeamInformation::create([ 
            'artist_id' => Auth::guard('artist')->user()->id,
            'team_name'=>$request->team_name,
            'phone_number'=>$request->phone_number,
            'alt_phone_number'=>$request->alt_phone_number,
            'address'=>$request->address,
            'skill_category'=>$request->skill_category,
            'about_team'=> $request->about_team,
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
        return ($info);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $info= ArtistTeamInformation::where('id', $id)->first();
        // var_dump(Auth::guard('artist')->user()->id != $info->artist_id);

        return $this->isNotAuthorized($info) ? $this->isNotAuthorized($info) :  new ArtistTeamInformationResource($info);
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
        $info=ArtistTeamInformation::where('id',$id)->first();

        if(Auth::guard('artist')->user()->id != $info->artist_id){
            return ('You are not authorized to make request');
        
        }

        $info->update($request->all());

        return new ArtistTeamInformationResource($info);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $info=ArtistTeamInformation::where('id',$id)->first();
        
        if(Auth::guard('artist')->user()->id != $info->artist_id){
            return ('You are not authorized to make request');
        
        }
        $info->delete();
        return response(null,204);
    }

    private function isNotAuthorized($info){

        if(Auth::guard('artist')->user()->id !== $info->artist_id){
            return ('You are not authorized to make request ');
          }
    }

    public function featuredTeam()
{
    try {
        // Retrieve featured artist information with selected columns
        $featuredArtists = ArtistTeamInformation::where('featured', 1)
            ->select('id','profile_photo', 'team_name', 'skill_category','price_per_hour')
            ->get();
        
        // Return the retrieved featured artist information
        return $featuredArtists;
    } catch (\Exception $e) {
        // Handle the exception, you can log it or return an error response
        return response()->json(['error' => 'An error occurred while fetching featured artist information.'], 500);
    }
}

//to fetch profile_photo,name and skills
 public function TeamInformation($id)
 {
     try {
         // Retrieve featured artist information with selected columns
         $featuredArtists = ArtistTeamInformation::where('id', $id)
             ->select('profile_photo', 'team_name', 'skill_category','price_per_hour','about_team','image1','image2','image3','image4','special_message')
             ->get();
         
         // Return the retrieved featured artist information
         return $featuredArtists;
     } catch (\Exception $e) {
         // Handle the exception, you can log it or return an error response
         return response()->json(['error' => 'An error occurred while fetching featured artist information.'], 500);
     }
 }
}
