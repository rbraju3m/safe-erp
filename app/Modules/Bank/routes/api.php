<?php

Route::group(['module' => 'Expense', 'middleware' => ['api'], 'namespace' => 'App\Modules\Expense\Controllers'], function() {

    Route::resource('Expense', 'ExpenseController');

});
