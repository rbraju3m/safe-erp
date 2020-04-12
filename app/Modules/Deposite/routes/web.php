<?php

Route::group(['module' => 'Deposite', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Deposite\Controllers'], function() {

    // Route::resource('Deposite', 'DepositeController');
    include 'deposite.php';

});