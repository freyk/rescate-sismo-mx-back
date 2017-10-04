<?php

use Illuminate\Http\Request;
use App\Http\ApiResponse;

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

Route::get('/login', function (Request $request, ApiResponse $response) {

    return $response->httpResponseBadRequest('Invalid access token');

})->name('login');

// Routes protected by Access Token
Route::middleware('client')->group(function () {

    // Persons
    Route::get('/persons', 'PersonsController@index');

});