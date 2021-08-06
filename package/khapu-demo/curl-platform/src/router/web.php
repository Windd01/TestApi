<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Khapu\CurlPlatform\Http\Controllers';

Route::namespace($namespace)->group(function()
{
    Route::get('sync-data-facebook/{facebookId}', 'TestController@saveDataByAccount');
    Route::get('cam', 'TestController@index');
    Route::get('facebook/{facebookId}', 'TestController@getAccount');
    Route::get('ads/{facebookId}', 'TestController@getAds');
    Route::get('campaigns/{facebookId}', 'TestController@getAds');
});