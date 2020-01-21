<?php

Route::get('admin-menu-create', [
	    'as' => 'admin.menu.create',
	    'uses' => 'MenuController@create'
	]);

	Route::post('admin-menu-store',[
		'as' => 'admin.menu.store',
		'uses' => 'MenuController@store'
	]);

	Route::get('admin-menu-index',[
		'as' => 'admin.menu.index',
		'uses' => 'MenuController@index'
	]);

	Route::get('admin-menu-edit/{id}',[
		'as' => 'admin.menu.edit',
		'uses' => 'MenuController@edit'
	]);

	Route::PATCH('admin-menu-update/{id}',[
		'as' => 'admin.menu.update',
		'uses' => 'MenuController@update'
	]);

	Route::get('admin-menu-cancel/{id}',[
		'as' => 'admin.menu.cancel',
		'uses' => 'MenuController@cancel'
	]);

	Route::get('admin-menu-cancellist',[
		'as' => 'admin.menu.cancellist',
		'uses' => 'MenuController@cancellist'
	]);

	Route::get('admin-menu-rollback/{id}',[
		'as' => 'admin.menu.rollback',
		'uses' => 'MenuController@rollback'
	]);

	Route::get('admin-menu-delete/{id}',[
		'as' => 'admin.menu.delete',
		'uses' => 'MenuController@delete'
	]);