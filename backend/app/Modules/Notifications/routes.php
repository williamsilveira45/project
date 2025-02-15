<?php

Route::group(['prefix' => 'notifications', 'namespace' => 'App\Modules\Notifications\Http\Controllers'], function () {
    Route::post('/', 'NotificationController@create');
    Route::put('/{notification}', 'NotificationController@update');
    Route::get('/', 'NotificationController@list');
    Route::delete('/{notification}', 'NotificationController@delete');
    Route::get('/{notification}', 'NotificationController@show');
});
