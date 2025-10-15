<?php

Route::prefix('admin-member')->name('admin.member.')->group(function () {

    Route::get('create', 'UserController@create')->name('create');
    Route::post('store', 'UserController@store')->name('store');
    Route::get('index', 'UserController@index')->name('index');
    Route::get('edit/{id}', 'UserController@edit')->name('edit');
    Route::patch('update/{id}', 'UserController@update')->name('update');
    Route::get('inactive', 'UserController@inactivelist')->name('inactive');

    Route::post('rollback/{id}', 'UserController@rollback')->name('rollback'); // changed to POST
    Route::delete('destroy/{id}', 'UserController@destroy')->name('destroy'); // changed to DELETE
    Route::delete('delete/{id}', 'UserController@delete')->name('delete'); // changed to DELETE
    Route::delete('permanent-delete/{id}', 'UserController@permanentDelete')->name('permanentDelete'); // standardized

    Route::get('show/{id}', 'UserController@show')->name('show');

    Route::get('showDeposite', 'UserController@showDeposite')->name('showDeposite');
    Route::get('depositeDetails/{id}', 'UserController@depositeDetails')->name('depositeDetails');

    Route::get('password-change-form', 'UserController@ChangeForm')->name('password.change.form');
    Route::post('password-change', 'UserController@change')->name('password.change');

    Route::get('specificData', 'UserController@specificData')->name('specificData');

});

