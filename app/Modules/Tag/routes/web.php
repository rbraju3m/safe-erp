<?php

Route::group(['module' => 'Tag', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Tag\Controllers'], function() {

    Route::get('admin-tag-index', [
	    'as' => 'admin.tag.index',
	    'uses' => 'TagController@index'
	]);

	Route::get('admin-tag-create', [
	    'as' => 'admin.tag.create',
	    'uses' => 'TagController@create'
	]);

	Route::post('admin-tag-store', [
	    'as' => 'admin.tag.store',
	    'uses' => 'TagController@store'
	]);

	Route::get('admin-tag-edit/{id}', [
		'as' => 'admin.tag.edit',
		'uses' => 'TagController@edit'
	]);

	Route::PATCH('admin-tag-update/{id}', [
		'as' => 'admin.tag.update',
		'uses' => 'TagController@update'
	]);

	Route::get('admin-tag-destroy/{id}', [
		'as' => 'admin.tag.destroy',
		'uses' => 'TagController@destroy'
	]);

	Route::get('admin-tag-cancel', [
		'as' => 'admin.tag.cancel',
		'uses' => 'TagController@cancellist'
	]);

	Route::get('admin-tag-rollback/{id}', [
		'as' => 'admin.tag.rollback',
		'uses' => 'TagController@rollback'
	]);

	Route::get('admin-tag-delete/{id}', [
		'as' => 'admin.tag.delete',
		'uses' => 'TagController@delete'
	]);
});
