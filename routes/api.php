<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StallController;
use App\Http\Controllers\IcecreamController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\FavoriteStallController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\RateController;

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
    Route::post('register',           [ AuthController::class, 'register']);
    Route::post('login',              [ AuthController::class, 'login']);
});

Route::post('provider/callback',   [ SocialController::class, 'handleProviderCallback']);


Route::middleware(['is_admin'])->group(function()
{
    Route::post('stall/create',              [ StallController::class, 'store']);
    Route::get('stall/my',                   [ StallController::class, 'showMyStalls']);


    Route::middleware(['is_stall_owner'])->group(function()
    {

        Route::post('stall/update/{stall_id}',   [ StallController::class, 'update']);
        Route::delete('stall/delete/{stall_id}', [ StallController::class, 'destroy']);
        Route::post('icecream/store/{stall_id}', [ IcecreamController::class, 'store']);

    });

    Route::middleware(['is_icecream_owner'])->group(function()
    {

        Route::post('icecream/update/{icecream_id}',   [ IcecreamController::class, 'update']);
        Route::delete('icecream/delete/{icecream_id}', [ IcecreamController::class, 'destroy']);

    });
});

Route::middleware(['is_user'])->group(function()

{
    Route::post('stall/{stall_id}/opinion/create', [ OpinionController::class, 'store']);

    Route::post('fav/{stall_id}', [ FavoriteStallController::class, 'favorite'])
        ->middleware('has_favorite');

    Route::delete('unf/{stall_id}', [ FavoriteStallController::class, 'unfavorite']);
    Route::get('fav/index',       [ FavoriteStallController::class, 'index']);
    Route::get('fav/counter',     [ FavoriteStallController::class, 'favoriteCounter']);

    Route::post('icecream/vote/{id}', [ VoteController::class, 'store'])
        ->middleware('has_voted');

    Route::post('stall/rate/{id}',    [ RateController::class, 'store'])
        ->middleware('has_rated');

});

Route::get('stall/all',                      [ StallController::class, 'index']);
Route::get('stall/show/{stall_id}',          [ StallController::class, 'show']);
Route::get('stall/show/{stall_id}/opinions', [ StallController::class, 'showOpinions']);

Route::get('icecream/all',                [ IcecreamController::class, 'index']);
Route::get('icecream/show/{icecream_id}', [ IcecreamController::class, 'show']);
Route::post('icecream/search',            [ IcecreamController::class, 'search']);
