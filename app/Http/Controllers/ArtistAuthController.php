<?php

namespace App\Http\Controllers;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Http\Requests\LoginArtistRequest;
use App\Http\Requests\StoreArtistRequest;
use App\Models\Artist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ArtistAuthController extends Controller
{
    use HttpResponses; //importing trait


    public function login (LoginArtistRequest $request){

        $request->validated($request->all());
        $credentials = $request->only('email', 'password');

        $user = Artist::where('email', $request->email)->first();

        // Check if a user with the provided email exists
        if (!$user) {
            return $this->error('', 'User not found', 404);
        }
    
        // Verify the password
        if (!Hash::check($request->password, $user->password)) {
            return $this->error('', 'Invalid password', 401);
        }

        // if (!Auth::attempt($credentials)) {
        //     return $this->error('', 'Credentials do not match', 401);
        // }

    return $this->success([
        'user' => $user,
        'token' =>$user->createToken('Api Token of ' . $user->name)->plainTextToken
    ]);
   

      
    }

   
    public function register(StoreArtistRequest $request)
{
    $request->validated($request->all());

    $user = Artist::create([
        
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    return $this->success([
        'user' => $user,
        'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
    ]);
}

public function logout()
{
    // Auth::guard('artist')->user()->id,
    Auth::guard('artist')->user()->currentAccessToken()->delete();

    return $this->success([
        'message'=>'You have successfully been logged out and your token has been deleted'
    ]);
}
}
