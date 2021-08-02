<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/facebook', [\App\Http\Controllers\FacebookController::class, 'index']);
Route::get('/account', [\App\Http\Controllers\FacebookController::class, 'account']);
Route::get('/insight', [\App\Http\Controllers\FacebookController::class, 'insight']);
