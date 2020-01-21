<?php

Route::group(['module' => 'BreakingNews', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\BreakingNews\Controllers'], function() {

	Route::get('admin-breakingnews-create', [
	    'as' => 'admin.breakingnews.create',
	    'uses' => 'BreakingNewsController@create'
	]);
    
    Route::post('admin-breakingnews-store', [
	    'as' => 'admin.breakingnews.store',
	    'uses' => 'BreakingNewsController@store'
	]);

	Route::get('admin-breakingnews-index', [
	    'as' => 'admin.breakingnews.index',
	    'uses' => 'BreakingNewsController@index'
	]);

	Route::get('admin-breakingnews-edit/{id}', [
	    'as' => 'admin.breakingnews.edit',
	    'uses' => 'BreakingNewsController@edit'
	]);

	Route::PATCH('admin-breakingnews-update/{id}', [
		'as' => 'admin.breakingnews.update',
		'uses' => 'BreakingNewsController@update'
	]);

	Route::get('admin-breakingnews-destroy/{id}', [
		'as' => 'admin.breakingnews.destroy',
		'uses' => 'BreakingNewsController@destroy'
	]);

	Route::get('admin-breakingnews-cancel', [
		'as' => 'admin.breakingnews.cancel',
		'uses' => 'BreakingNewsController@cancellist'
	]);

	Route::get('admin-breakingnews-rollback/{id}', [
		'as' => 'admin.breakingnews.rollback',
		'uses' => 'BreakingNewsController@rollback'
	]);

	Route::get('admin-breakingnews-delete/{id}', [
		'as' => 'admin.breakingnews.delete',
		'uses' => 'BreakingNewsController@delete'
	]);
});

