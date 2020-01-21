<?php

Route::group(['module' => 'Settings', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Settings\Controllers'], function() {

    // frontend vedio route
    include 'frontend_vedio.php';

});
