<?php

use Illuminate\Http\Request;

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

//Login
Route::post('/login', 'LoginCtrl@login');


/* Admin Endpoints */

//User Endpoints
Route::middleware(['AllowedUserTypes:admin,user'])->group(function (){
    Route::post('/user', 'UserCtrl@create');
    Route::get('/user/{id}', 'UserCtrl@read');
});


//Intents

Route::post('/chatbot/intent', 'IntentCtrl@create');
Route::get('/chatbot/intent', 'IntentCtrl@read');
Route::get('/chatbot/intent/{id}', 'IntentCtrl@readSingle');
Route::delete('/chatbot/intent/{id}', 'IntentCtrl@delete');
Route::post('/chatbot/intent/{id}/{order}/insert-value', 'IntentCtrl@insertValue');

/* Admin Endpoints END */

Route::post('/chatbot', 'ChatCtrl@receive');

/* Test Endpoints */

Route::post('/feedback', 'TestCtrl@giveFeedback');
Route::get('/test-get', 'TestCtrl@testGet');
Route::get('/get-time', 'TestCtrl@getTime');
