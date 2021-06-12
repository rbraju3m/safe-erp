<?php

	Route::get('admin-expense-create', [
	    'as' => 'admin.expense.create',
	    'uses' => 'ExpenseController@create'
	]);

	Route::post('admin-expense-store',[
		'as' => 'admin.expense.store',
		'uses' => 'ExpenseController@store'
	]);

	Route::get('admin-expense-index',[
		'as' => 'admin.expense.index',
		'uses' => 'ExpenseController@index'
	]);

	Route::get('admin-expense-edit/{id}',[
		'as' => 'admin.expense.edit',
		'uses' => 'ExpenseController@edit'
	]);

	Route::PATCH('admin-expense-update/{id}',[
		'as' => 'admin.expense.update',
		'uses' => 'ExpenseController@update'
	]);

	Route::get('admin-expense-destroy/{id}',[
		'as' => 'admin.expense.destroy',
		'uses' => 'ExpenseController@destroy'
	]);

	Route::get('admin-expense-inactive',[
		'as' => 'admin.expense.inactive',
		'uses' => 'ExpenseController@inactivelist'
	]);

	Route::get('admin-expense-rollback/{id}',[
		'as' => 'admin.expense.rollback',
		'uses' => 'ExpenseController@rollback'
	]);

	Route::get('admin-expense-delete/{id}',[
		'as' => 'admin.expense.delete',
		'uses' => 'ExpenseController@delete'
	]);


	Route::get('admin-expense-intotal/{year}',[
		'as' => 'admin.expense.intotal',
		'uses' => 'ExpenseController@intotal'
	]);