<?php

Route::prefix('admin-bank')->name('admin.bank.')->group(function () {

    Route::get('create', 'BankController@create')->name('create');
    Route::post('store', 'BankController@store')->name('store');
    Route::get('index', 'BankController@index')->name('index');

    Route::get('edit/{id}', 'BankController@edit')->name('edit');
    Route::patch('update/{id}', 'BankController@update')->name('update');

    Route::get('destroy/{id}', 'BankController@destroy')->name('destroy');
    Route::get('inactive', 'BankController@inactivelist')->name('inactive');
    Route::get('rollback/{id}', 'BankController@rollback')->name('rollback');
    Route::get('delete/{id}', 'BankController@delete')->name('delete');

});
