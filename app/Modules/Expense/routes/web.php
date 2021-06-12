<?php

Route::group(['module' => 'Expense', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Expense\Controllers'], function() {

    include 'expense.php';

});
