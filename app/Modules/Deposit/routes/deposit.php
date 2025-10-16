<?php

Route::group(['prefix' => 'admin/deposit', 'as' => 'admin.deposit.'], function () {

    Route::get('create', 'DepositController@create')->name('create');
    Route::post('store', 'DepositController@store')->name('store');
    Route::get('index', 'DepositController@index')->name('index');
    Route::get('edit/{id}', 'DepositController@edit')->name('edit');
    Route::patch('update/{id}', 'DepositController@update')->name('update');
    Route::get('destroy/{id}', 'DepositController@destroy')->name('destroy');
    Route::get('inactive', 'DepositController@inactivelist')->name('inactive');
    Route::get('rollback/{id}', 'DepositController@rollback')->name('rollback');
    Route::get('delete/{id}', 'DepositController@delete')->name('delete');
    Route::get('in-total/{year}', 'DepositController@intotal')->name('intotal');
});
