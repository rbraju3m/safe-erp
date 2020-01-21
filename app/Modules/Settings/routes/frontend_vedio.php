<?php

	Route::get('admin-frontvedio-index',[
		'as' => 'admin.frontvedio.index',
		'uses' => 'VideoController@index'
	]);

	Route::get('admin-frontvedio-create',[
		'as' => 'admin.frontvedio.create',
		'uses' => 'VideoController@create'
	]);

	Route::post('admin-frontvedio-store',[
		'as' => 'admin.frontvedio.store',
		'uses' => 'VideoController@store'
	]);

	Route::get('admin-frontvedio-edit/{id}',[
		'as' => 'admin.frontvedio.edit',
		'uses' => 'VideoController@edit'
	]);

	Route::PATCH('admin-frontvedio-update/{id}',[
		'as' => 'admin.frontvedio.update',
		'uses' => 'VideoController@update'
	]);

	Route::get('admin-frontvedio-destroy/{id}',[
		'as' => 'admin.frontvedio.destroy',
		'uses' => 'VideoController@destroy'
	]);

	Route::get('admin-frontvedio-rollback/{id}',[
		'as' => 'admin.frontvedio.rollback',
		'uses' => 'VideoController@rollback'
	]);


	Route::get('admin-frontvedio-delete/{id}',[
		'as' => 'admin.frontvedio.delete',
		'uses' => 'VideoController@delete'
	]);

	Route::get('admin-frontvedio-cancellist',[
		'as' => 'admin.frontvedio.cancellist',
		'uses' => 'VideoController@cancellist'
	]);

	

	