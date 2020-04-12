<?php

Route::group(['module' => 'Deposite', 'middleware' => ['api'], 'namespace' => 'App\Modules\Deposite\Controllers'], function() {

    Route::resource('Deposite', 'DepositeController');

});
