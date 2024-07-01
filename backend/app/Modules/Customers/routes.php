<?php

Route::group(['prefix' => 'users', 'namespace' => 'App\Modules\Users\Http\Controllers'], function () {
    Route::post('login', 'UserController@login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('register', 'UserController@register');
        Route::get('me', 'UserController@me');
        Route::group(['prefix' => '{user}'], function () {
            Route::post('update', 'UserController@update');
            Route::delete('delete', 'UserController@delete');
            Route::delete('logout', 'UserController@logout');
        });
    });
});
