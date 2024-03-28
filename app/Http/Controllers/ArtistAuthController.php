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

    if (!Auth::attempt($credentials)) {
        return $this->error('', 'Credentials do not match', 401);
    }

    $user = Artist::where('email', $request->email)->first();

    return $this->success([
        'user' => $user,
        'token' =>$user->createToken('Api Token of ' . $user->name)->plainTextToken
    ]);

        // if(!Auth::attempt([$request->only('email','password')])){
        //     return $this->error('','credentials do not match',401);
        // }
        // return 'this is my login method';
    }

   
    public function register(StoreArtistRequest $request)
{
    $request->validated($request->all());

    $user = Artist::create([
        'name' => $request->name,
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
    Auth::user()->currentAccessToken()->delete();

    return $this->success([
        'message'=>'You have successfully been logged out and your token has been deleted'
    ]);
}
}
