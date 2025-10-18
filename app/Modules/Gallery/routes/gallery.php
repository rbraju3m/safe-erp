<?php

Route::prefix('admin-gallery')->name('admin.gallery.')->group(function () {
    Route::get('folders', 'GalleryController@folderList')->name('folders');

    Route::get('create', 'GalleryController@create')->name('create');
    Route::post('store', 'GalleryController@store')->name('store');
    Route::get('index/{folder}', 'GalleryController@index')->name('index');

    Route::get('edit/{id}', 'GalleryController@edit')->name('edit');
    Route::patch('update/{id}', 'GalleryController@update')->name('update');

    Route::get('destroy/{id}', 'GalleryController@destroy')->name('destroy');
    Route::get('inactive', 'GalleryController@inactivelist')->name('inactive');
    Route::get('rollback/{id}', 'GalleryController@rollback')->name('rollback');
    Route::get('delete/{id}', 'GalleryController@delete')->name('delete');

});
