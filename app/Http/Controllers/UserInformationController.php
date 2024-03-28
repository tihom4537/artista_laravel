<?php

namespace App\Http\Controllers;
use App\Models\UserInformation;
use Database\Factories\UserFactory;
use App\Http\Resources\UserInformationResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserInformationRequest;




use Illuminate\Http\Request;

class UserInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return UserInformationResource::collection(
        //     UserInformation::where('user_id', Auth::user()->id)->get()
        // );
        return UserInformation::all();
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserInformationRequest $request)
    {
        // $request->validated($request->all());

        $info =UserInformation::create([
            'user_id'=>Auth::user()->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone_no'=>$request->phone_no,
            'house_no_building'=>$request->house_no_building,
            'city'=>$request->city,
            'state'=>$request->state,
            'pin'=> $request->pin,
            'profile_photo'=>$request->profile_photo

        ]);

        return new UserInformationResource($info);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

    
     $info= UserInformation::where('id', $id)->first();

     return $this->isNotAuthorized($info) ? $this->isNotAuthorized($info) : new UserInformationResource($info);
    //  if(Auth::user()->id !== $info->user_id){
    //     return ('You are not authorized to make request');
    //   }
    // //      return $info;

    //   return new UserInformationResource($info);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $info= UserInformation::where('id', $id)->first();
        if(Auth::user()->id !== $info->user_id){
            return ('You are not authorized to make request');
          }
        $info->update($request->all());

        return new UserInformationResource($info);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $info= UserInformation::where('id', $id)->first();
        $info->delete();

        return response (null,204);
    }

    private function isNotAuthorized($info){

        if(Auth::user()->id !== $info->user_id){
            return ('You are not authorized to make request ');
          }
    }
}
