<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserInformationController;
use App\Http\Controllers\ArtistAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/login' , [AuthController::class, 'login']);

// Route::post ('/register', [AuthController::class, 'register']); 

//public routes 
Route::post('/login' , [AuthController::class, 'login']);

Route::post ('/register', [AuthController::class, 'register']);
Route::post('/logout' , [AuthController::class, 'logout']);



Route::post('artist/login', [ArtistAuthController::class, 'login'])->name('artist.login');
Route::post('artist/logout', [ArtistAuthController::class, 'logout'])->name('artist.logout');
Route::post ('artist/register', [ArtistAuthController::class, 'register'])->name('artist.register');


// Protected  route 
Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::resource('/info', UserInformationController::class);
    Route::post('/logout' , [AuthController::class, 'logout']);
});
