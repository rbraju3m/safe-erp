<?php
	Route::get('admin-profit-sharing',[
		'as' => 'admin_profit_sharing',
		'uses' => 'ProfitSharingController@create'
	]);

	Route::get('admin-year-wise-profit-expense',[
		'as' => 'get_year_wise_profit_expense',
		'uses' => 'ProfitSharingController@getYearWiseProfitExpense'
	]);

    Route::post('profit-generate',[
        'as' => 'profit_generate',
        'uses' => 'ProfitSharingController@profitGenerate'
    ]);
