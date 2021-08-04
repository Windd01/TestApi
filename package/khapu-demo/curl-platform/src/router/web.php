<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Khapu\CurlPlatform\Http\Controllers';

Route::namespace($namespace)->group(function()
{
    Route::get('khapu/curl-platform/test', 'TestController@index');
    Route::get('facebook/{facebookId}', 'TestController@getAccount');
    Route::get('ads/{facebookId}', 'TestController@getAds');
});