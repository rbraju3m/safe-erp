<?php

	Route::get('admin-member-create', [
	    'as' => 'admin.member.create',
	    'uses' => 'UserController@create'
	]);

	Route::post('admin-member-store',[
		'as' => 'admin.member.store',
		'uses' => 'UserController@store'
	]);

	Route::get('admin-member-index',[
		'as' => 'admin.member.index',
		'uses' => 'UserController@index'
	]);

	Route::get('admin-member-edit/{id}',[
		'as' => 'admin.member.edit',
		'uses' => 'UserController@edit'
	]);

	Route::PATCH('admin-member-update/{id}',[
		'as' => 'admin.member.update',
		'uses' => 'UserController@update'
	]);

	Route::get('admin-member-cancel/{id}',[
		'as' => 'admin.member.cancel',
		'uses' => 'UserController@cancel'
	]);

	Route::get('admin-member-show',[
		'as' => 'admin.member.show',
		'uses' => 'UserController@show'
	]);

	Route::get('admin-member-inactive',[
		'as' => 'admin.member.inactive',
		'uses' => 'UserController@inactivelist'
	]);

	Route::get('admin-member-rollback/{id}',[
		'as' => 'admin.member.rollback',
		'uses' => 'UserController@rollback'
	]);

	Route::get('admin-member-destroy/{id}',[
		'as' => 'admin.member.destroy',
		'uses' => 'UserController@destroy'
	]);