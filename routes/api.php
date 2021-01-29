<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return 5;
});
Route::post('/users', 'ApiUserController@getAll');
Route::post('/user/login', 'ApiUserController@login');
Route::post('/user/registration', 'ApiUserController@store');
Route::get('/login', 'ApiUserController@login');




