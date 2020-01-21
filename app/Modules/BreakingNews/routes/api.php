<?php

Route::group(['module' => 'BreakingNews', 'middleware' => ['api'], 'namespace' => 'App\Modules\BreakingNews\Controllers'], function() {

    Route::resource('BreakingNews', 'BreakingNewsController');

});
