<?php

Route::group(['module' => 'Deposit', 'middleware' => ['api'], 'namespace' => 'App\Modules\Deposite\Controllers'], function() {

    Route::resource('Deposit', 'DepositController');

});
