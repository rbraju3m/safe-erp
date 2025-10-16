<?php

Route::group(['module' => 'Deposit', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Deposit\Controllers'], function() {

    include 'deposit.php';

});
