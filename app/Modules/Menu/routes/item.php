<?php
	Route::get('admin-menuitem-create', [
	    'as' => 'admin.menuitem.create',
	    'uses' => 'ItemController@create'
	]);

	Route::post('admin-menuitem-store', [
	    'as' => 'admin.menuitem.store',
	    'uses' => 'ItemController@store'
	]);

	Route::get('admin-menuitem-index', [
	    'as' => 'admin.menuitem.index',
	    'uses' => 'ItemController@index'
	]);

	Route::get('admin-menuitem-edit/{id}', [
	    'as' => 'admin.menuitem.edit',
	    'uses' => 'ItemController@edit'
	]);

	Route::PATCH('admin-menuitem-update/{id}',[
		'as' => 'admin.menuitem.update',
		'uses' => 'ItemController@update'
	]);


	Route::get('admin-menuitem-delete/{id}',[
		'as' => 'admin.menuitem.delete',
		'uses' => 'ItemController@delete'
	]);
	