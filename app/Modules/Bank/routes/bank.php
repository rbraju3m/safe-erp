<?php

	Route::get('admin-bank-create', [
	    'as' => 'admin.bank.create',
	    'uses' => 'BankController@create'
	]);

	Route::post('admin-bank-store',[
		'as' => 'admin.bank.store',
		'uses' => 'BankController@store'
	]);

	Route::get('admin-bank-index',[
		'as' => 'admin.bank.index',
		'uses' => 'BankController@index'
	]);

	Route::get('admin-bank-edit/{id}',[
		'as' => 'admin.bank.edit',
		'uses' => 'BankController@edit'
	]);

	Route::PATCH('admin-bank-update/{id}',[
		'as' => 'admin.bank.update',
		'uses' => 'BankController@update'
	]);

	Route::get('admin-bank-destroy/{id}',[
		'as' => 'admin.bank.destroy',
		'uses' => 'BankController@destroy'
	]);

	Route::get('admin-bank-inactive',[
		'as' => 'admin.bank.inactive',
		'uses' => 'BankController@inactivelist'
	]);

	Route::get('admin-bank-rollback/{id}',[
		'as' => 'admin.bank.rollback',
		'uses' => 'BankController@rollback'
	]);

	Route::get('admin-bank-delete/{id}',[
		'as' => 'admin.bank.delete',
		'uses' => 'BankController@delete'
	]);


	Route::get('admin-bank-intotal/{year}',[
		'as' => 'admin.bank.intotal',
		'uses' => 'BankController@intotal'
	]);

	Route::get('admin-profit-sharing',[
		'as' => 'admin_profit_sharing',
		'uses' => 'BankController@intotal'
	]);
