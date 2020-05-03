<?php

Route::group(['module' => 'Gallery', 'middleware' => ['api'], 'namespace' => 'App\Modules\Gallery\Controllers'], function() {

    Route::resource('Gallery', 'GalleryController');

});
