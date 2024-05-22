<?php

namespace App\Http\Controllers;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;





use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses; //importing trait


    public function login (LoginUserRequest $request){

        $request->validated($request->all());
        $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return $this->error('', 'Credentials do not match', 401);
    }

    $user = User::where('email', $request->email)->first();

    return $this->success([
        'user' => $user,
        'token' =>$user->createToken('Api Token of ' . $user->email)->plainTextToken
    ]);

        // if(!Auth::attempt([$request->only('email','password')])){
        //     return $this->error('','credentials do not match',401);
        // }
        // return 'this is my login method';
    }

   
    public function register(StoreUserRequest $request)
{
    $request->validated($request->all());

    $user = User::create([
        // 'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    return $this->success([
        'user' => $user,
        'token' => $user->createToken('API Token of ' . $user->email)->plainTextToken
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
