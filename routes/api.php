<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Transaction
    Route::apiResource('transactions', 'TransactionApiController');

    // Ipn
    Route::apiResource('ipns', 'IpnApiController', ['except' => ['store', 'update', 'destroy']]);
});
