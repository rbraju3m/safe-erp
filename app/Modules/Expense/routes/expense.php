<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin-expense')->name('admin.expense.')->group(function () {

    Route::get('create', [
        'as' => 'create',
        'uses' => 'ExpenseController@create'
    ]);

    Route::post('store', [
        'as' => 'store',
        'uses' => 'ExpenseController@store'
    ]);

    Route::get('index', [
        'as' => 'index',
        'uses' => 'ExpenseController@index'
    ]);

    Route::get('edit/{id}', [
        'as' => 'edit',
        'uses' => 'ExpenseController@edit'
    ]);

    Route::patch('update/{id}', [
        'as' => 'update',
        'uses' => 'ExpenseController@update'
    ]);

    Route::get('destroy/{id}', [
        'as' => 'destroy',
        'uses' => 'ExpenseController@destroy'
    ]);

    Route::get('inactive', [
        'as' => 'inactive',
        'uses' => 'ExpenseController@inactivelist'
    ]);

    Route::get('rollback/{id}', [
        'as' => 'rollback',
        'uses' => 'ExpenseController@rollback'
    ]);

    Route::get('delete/{id}', [
        'as' => 'delete',
        'uses' => 'ExpenseController@delete'
    ]);

    Route::get('intotal/{year}', [
        'as' => 'intotal',
        'uses' => 'ExpenseController@intotal'
    ]);

});
