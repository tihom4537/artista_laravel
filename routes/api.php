<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserInformationController;
use App\Http\Controllers\ArtistAuthController;
use App\Http\Controllers\ArtistInformationController;
use App\Http\Controllers\ArtistTeamInformationController;
use App\Http\Controllers\TeamMemberInformationController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\CreateOrderController;
use App\Http\Controllers\PaymentController;


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
Route::post('/payment/success' , [PaymentController::class, 'store']);


Route::post('artist/login', [ArtistAuthController::class, 'login'])->name('artist.login');
Route::post('artist/logout', [ArtistAuthController::class, 'logout'])->name('artist.logout');
Route::post ('artist/register', [ArtistAuthController::class, 'register'])->name('artist.register');


// Protected  route 
Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::resource('/info', UserInformationController::class);
    Route::post('/logout' , [AuthController::class, 'logout']);
});
Route::get('home/featured',[ArtistInformationController::class,'featured']);
Route::get('home/categories/{skill_category}', [ArtistInformationController::class, 'getBySkillCategory']);
Route::get('featured/artist_info/{id}',[ArtistInformationController::class,'ArtistInformation']);
Route::get('home/featured/team',[ArtistTeamInformationController::class,'featuredTeam']);
Route::get('featured/team/{id}',[ArtistTeamInformationController::class,'TeamInformation']);



Route::resource('artist/team_info', ArtistTeamInformationController::class);
Route::resource('artist/team_member', TeamMemberInformationController::class);


Route::post('/upload-image', [ImageUploadController::class, 'upload']);
Route::post('/sms', [SMSController::class, 'SMS']);

Route::group(['middleware'=> ['auth:sanctum']],function(){
Route::resource('/booking', BookingController::class);
});
Route::middleware(['auth:artist'])->group(function () {
    // Routes that require authentication as an artist go here
    Route::resource('artist/info', ArtistInformationController::class);
});
// Route::resource('artist/info', ArtistInformationController::class);

// Route::group(['middleware'=> ['auth:sanctum']],function(){
//     Route::resource('artist/info', ArtistInformationController::class);
//     // Route::post('artist/logout' , [AuthController::class, 'logout']);
// });

Route::get('/order', [CreateOrderController::class, 'getData']);

