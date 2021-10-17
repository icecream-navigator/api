<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\StallController;
use App\Http\Controllers\IcecreamController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\FacebookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('register',           [ RegisterController::class, 'register']);
    Route::post('login',              [ LoginController::class, 'login']);
    Route::get('profile',             [ ProfileController::class, 'profile']);
});

Route::get('google',          [ GoogleController::class, 'redirectToGoogle']);
Route::get('facebook',          [ FacebookController::class, 'redirectToFacebook']);
Route::get('google/callback', [ GoogleController::class, 'handleGoogleCallback']);
Route::get('facebook/callback', [ FacebookController::class, 'handleFacebookCallback']);

Route::get('stall/all',                [ StallController::class, 'index']);
Route::get('stall/show/{stall_id}',           [ StallController::class, 'show']);
Route::get('stall/show/{stall_id}/opinions', [ StallController::class, 'showOpinions']);

Route::middleware(['jwt.auth'])->group(function()
{
    Route::post('stall/create',           [ StallController::class, 'store']);
    Route::delete('stall/delete/{stall_id}',    [ StallController::class, 'destroy']);

    Route::post('icecream/store/{id}',       [ IcecreamController::class, 'store']);
    Route::post('icecream/update/{id}',      [ IcecreamController::class, 'update']);
    Route::delete('icecream/delete/{id}',    [ IcecreamController::class, 'destroy']);

    Route::post('stall/{stall_id}/opinion/create', [ OpinionController::class, 'store']);

});

