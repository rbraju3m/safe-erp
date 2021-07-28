<?php

Route::group(['module' => 'Bank', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Bank\Controllers'], function() {

    include 'bank.php';

});
