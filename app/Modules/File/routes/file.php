<?php

	Route::get('admin-file-create', [
	    'as' => 'admin.file.create',
	    'uses' => 'FileController@create'
	]);

	Route::post('admin-file-store',[
		'as' => 'admin.file.store',
		'uses' => 'FileController@store'
	]);

	Route::get('admin-file-index',[
		'as' => 'admin.file.index',
		'uses' => 'FileController@index'
	]);

	Route::get('admin-file-edit/{id}',[
		'as' => 'admin.file.edit',
		'uses' => 'FileController@edit'
	]);

	Route::PATCH('admin-file-update/{id}',[
		'as' => 'admin.file.update',
		'uses' => 'FileController@update'
	]);

	Route::get('admin-file-destroy/{id}',[
		'as' => 'admin.file.destroy',
		'uses' => 'FileController@destroy'
	]);

	Route::get('admin-file-inactive',[
		'as' => 'admin.file.inactive',
		'uses' => 'FileController@inactivelist'
	]);

	Route::get('admin-file-rollback/{id}',[
		'as' => 'admin.file.rollback',
		'uses' => 'FileController@rollback'
	]);

	Route::get('admin-file-delete/{id}',[
		'as' => 'admin.file.delete',
		'uses' => 'FileController@delete'
	]);
