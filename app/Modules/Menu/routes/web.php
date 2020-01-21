<?php

Route::group(['module' => 'Menu', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Menu\Controllers'], function() {

	// menu route
    include 'menu.php';

	// menu item route
    include 'item.php';
	

});


