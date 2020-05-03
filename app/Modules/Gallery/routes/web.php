<?php

Route::group(['module' => 'Gallery', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Gallery\Controllers'], function() {

    // Route::resource('Gallery', 'GalleryController');
    include 'gallery.php';


});
