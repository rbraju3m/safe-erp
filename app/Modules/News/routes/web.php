<?php

Route::group(['module' => 'News', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\News\Controllers'], function() {

    Route::get('admin-news-index', [
	    'as' => 'admin.news.index',
	    'uses' => 'NewsController@index'
	]);

	Route::get('admin-news-create', [
	    'as' => 'admin.news.create',
	    'uses' => 'NewsController@create'
	]);

	Route::get('admin-news-show/{id}', [
	    'as' => 'admin.news.show',
	    'uses' => 'NewsController@show'
	]);

	Route::post('admin-news-store', [
	    'as' => 'admin.news.store',
	    'uses' => 'NewsController@store'
	]);

	Route::get('admin-news-edit/{id}', [
	    'as' => 'admin.news.edit',
	    'uses' => 'NewsController@edit'
	]);

	Route::patch('admin-news-update/{id}', [
	    'as' => 'admin.news.update',
	    'uses' => 'NewsController@update'
	]);

	Route::get('admin-news-destroy/{id}', [
	    'as' => 'admin.news.destroy',
	    'uses' => 'NewsController@destroy'
	]);

	Route::get('admin-news-cancel-list', [
	    'as' => 'admin.news.cancel.list',
	    'uses' => 'NewsController@cancellist'
	]);

	Route::get('admin-news-rollback/{id}', [
	    'as' => 'admin.news.rollback',
	    'uses' => 'NewsController@rollback'
	]);

	Route::get('admin-news-delete/{id}', [
	    'as' => 'admin.news.delete',
	    'uses' => 'NewsController@delete'
	]);


	Route::get('admin-news-place/{name}', [
	    'as' => 'admin.news.place',
	    'uses' => 'NewsController@place'
	]);

	Route::post('admin-news-place-store', [
	    'as' => 'admin.news.place.store',
	    'uses' => 'NewsController@add'
	]);

});
