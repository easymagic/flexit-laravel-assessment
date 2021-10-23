<?php

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('migrate-fresh', function () {
    // return Profile::all();
    Artisan::call('migrate:fresh',[
        '--force' => true
    ]);
    return [
        'message'=>'Migrated.'
    ];

});


Route::get('profiles', function () {
    return Profile::all();
});
