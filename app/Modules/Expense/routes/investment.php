<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin-investment')->name('admin.investment.')->group(function () {

    Route::get('create', [
        'as' => 'create',
        'uses' => 'InvestmentController@create'
    ]);

    Route::post('store', [
        'as' => 'store',
        'uses' => 'InvestmentController@store'
    ]);

    Route::get('index', [
        'as' => 'index',
        'uses' => 'InvestmentController@index'
    ]);

    Route::get('edit/{id}', [
        'as' => 'edit',
        'uses' => 'InvestmentController@edit'
    ]);

    Route::patch('update/{id}', [
        'as' => 'update',
        'uses' => 'InvestmentController@update'
    ]);

    Route::get('destroy/{id}', [
        'as' => 'destroy',
        'uses' => 'InvestmentController@destroy'
    ]);

    Route::get('inactive', [
        'as' => 'inactive',
        'uses' => 'InvestmentController@inactivelist'
    ]);

    Route::get('rollback/{id}', [
        'as' => 'rollback',
        'uses' => 'InvestmentController@rollback'
    ]);

    Route::get('delete/{id}', [
        'as' => 'delete',
        'uses' => 'InvestmentController@delete'
    ]);

});
