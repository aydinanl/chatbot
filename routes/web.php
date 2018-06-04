<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('chatV2');
});

/* Login Endpoints */
Route::post('/login', 'LoginCtrl@loginWeb');
Route::get('/login', 'LoginCtrl@index')->name('login-index');
Route::get('/logout', 'LoginCtrl@logout');

/* Admin Endpoints */
Route::middleware(['CheckTokenWeb'])->group(function (){
    //Dashboard
    Route::get('/admin', 'Admin\DashboardCtrl@index');
    Route::get('/admin/dashboard', 'Admin\DashboardCtrl@index');

    //Intents
    Route::get('/admin/intents', 'Admin\IntentsCtrl@index');
    Route::get('/admin/intent/add', 'Admin\IntentsCtrl@addIndex');
    Route::get('/admin/intent/edit/{id}', 'Admin\IntentsCtrl@editIndex');
    Route::post('/admin/intent/add', 'Admin\IntentsCtrl@addIntent');
    Route::get('/admin/intent/delete/{id}', 'Admin\IntentsCtrl@intentDelete')->name('intent-delete');

    //Profile
    Route::get('/admin/profile', 'Admin\ProfileCtrl@index');
    Route::post('/admin/profile', 'Admin\ProfileCtrl@save');
});