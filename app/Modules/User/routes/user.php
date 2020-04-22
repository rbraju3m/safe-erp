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

	Route::get('admin-member-delete/{id}',[
		'as' => 'admin.member.delete',
		'uses' => 'UserController@delete'
	]);


	Route::get('admin-member-show/{id}',[
		'as' => 'admin.member.show',
		'uses' => 'UserController@show'
	]);


	Route::get('admin-member-showDeposite',[
		'as' => 'admin.member.showDeposite',
		'uses' => 'UserController@showDeposite'
	]);

	Route::get('admin-member-depositeDetails/{id}',[
		'as' => 'admin.member.depositeDetails',
		'uses' => 'UserController@depositeDetails'
	]);

	Route::get('admin-password-ChangeForm',[
		'as' => 'admin.password.ChangeForm',
		'uses' => 'UserController@ChangeForm'
	]);

	Route::post('admin-password-change',[
		'as' => 'admin.password.change',
		'uses' => 'UserController@change'
	]);

	Route::get('admin-member-specificData',[
		'as' => 'admin.member.specificData',
		'uses' => 'UserController@specificData'
	]);