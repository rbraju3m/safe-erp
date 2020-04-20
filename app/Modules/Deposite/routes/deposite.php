<?php

	Route::get('admin-deposite-create', [
	    'as' => 'admin.deposite.create',
	    'uses' => 'DepositeController@create'
	]);

	Route::post('admin-deposite-store',[
		'as' => 'admin.deposite.store',
		'uses' => 'DepositeController@store'
	]);

	Route::get('admin-deposite-index',[
		'as' => 'admin.deposite.index',
		'uses' => 'DepositeController@index'
	]);

	Route::get('admin-deposite-edit/{id}',[
		'as' => 'admin.deposite.edit',
		'uses' => 'DepositeController@edit'
	]);

	Route::PATCH('admin-deposite-update/{id}',[
		'as' => 'admin.deposite.update',
		'uses' => 'DepositeController@update'
	]);

	Route::get('admin-deposite-destroy/{id}',[
		'as' => 'admin.deposite.destroy',
		'uses' => 'DepositeController@destroy'
	]);

	Route::get('admin-deposite-inactive',[
		'as' => 'admin.deposite.inactive',
		'uses' => 'DepositeController@inactivelist'
	]);

	Route::get('admin-deposite-rollback/{id}',[
		'as' => 'admin.deposite.rollback',
		'uses' => 'DepositeController@rollback'
	]);

	Route::get('admin-deposite-delete/{id}',[
		'as' => 'admin.deposite.delete',
		'uses' => 'DepositeController@delete'
	]);


	Route::get('admin-deposite-intotal/{year}',[
		'as' => 'admin.deposite.intotal',
		'uses' => 'DepositeController@intotal'
	]);