<?php

Route::group(['module' => 'File', 'middleware' => ['api'], 'namespace' => 'App\Modules\File\Controllers'], function() {

    Route::resource('File', 'FileController');

});
