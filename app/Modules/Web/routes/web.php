<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

}

Route::group(['module' => 'Web', 'middleware' => ['web'], 'namespace' => 'App\Modules\Web\Controllers'], function() {

    
   include('forntend_news_route.php');

});


