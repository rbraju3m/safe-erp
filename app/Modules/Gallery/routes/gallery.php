<?php

	Route::get('admin-gallery-create', [
	    'as' => 'admin.gallery.create',
	    'uses' => 'GalleryController@create'
	]);

	Route::post('admin-gallery-store',[
		'as' => 'admin.gallery.store',
		'uses' => 'GalleryController@store'
	]);

	Route::get('admin-gallery-index',[
		'as' => 'admin.gallery.index',
		'uses' => 'GalleryController@index'
	]);

	Route::get('admin-gallery-edit/{id}',[
		'as' => 'admin.gallery.edit',
		'uses' => 'GalleryController@edit'
	]);

	Route::PATCH('admin-gallery-update/{id}',[
		'as' => 'admin.gallery.update',
		'uses' => 'GalleryController@update'
	]);

	Route::get('admin-gallery-destroy/{id}',[
		'as' => 'admin.gallery.destroy',
		'uses' => 'GalleryController@destroy'
	]);

	Route::get('admin-gallery-inactive',[
		'as' => 'admin.gallery.inactive',
		'uses' => 'GalleryController@inactivelist'
	]);

	Route::get('admin-gallery-rollback/{id}',[
		'as' => 'admin.gallery.rollback',
		'uses' => 'GalleryController@rollback'
	]);

	Route::get('admin-gallery-delete/{id}',[
		'as' => 'admin.gallery.delete',
		'uses' => 'GalleryController@delete'
	]);
