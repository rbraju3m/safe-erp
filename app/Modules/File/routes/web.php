<?php

Route::group(['module' => 'File', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\File\Controllers'], function() {

    // Route::resource('File', 'FileController');
    include 'file.php';


});