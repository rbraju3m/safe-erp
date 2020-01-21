<?php

Route::group(['module' => 'Tag', 'middleware' => ['api'], 'namespace' => 'App\Modules\Tag\Controllers'], function() {

    Route::resource('tag', 'TagController');

});
