<?php

Route::group(['prefix' => 'customers', 'namespace' => 'App\Modules\Customers\Http\Controllers'], function () {
    Route::post('/', 'CustomerController@create');
    Route::post('/{customer}/addresses', 'CustomerController@createAddress');
    Route::post('/{customer}/notes', 'CustomerController@createNote');
    Route::post('/{customer}/phones', 'CustomerController@createPhone');
});
