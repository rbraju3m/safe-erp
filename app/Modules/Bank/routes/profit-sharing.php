<?php
    Route::get('admin-profit-sharing-index',[
        'as' => 'admin_profit_sharing_index',
        'uses' => 'ProfitSharingController@profitSharingIndex'
    ]);

	Route::get('admin-profit-sharing',[
		'as' => 'admin_profit_sharing',
		'uses' => 'ProfitSharingController@create'
	]);

    Route::post('profit-generate',[
        'as' => 'profit_generate',
        'uses' => 'ProfitSharingController@profitGenerate'
    ]);

    Route::post('profit-generate-store',[
        'as' => 'profit_generate_store',
        'uses' => 'ProfitSharingController@profitGenerateStore'
    ]);

    Route::get('admin-profit-details',[
        'as' => 'profit_details',
        'uses' => 'ProfitSharingController@profitSharingDetails'
    ]);

	Route::get('admin-year-wise-profit-expense',[
		'as' => 'get_year_wise_profit_expense',
		'uses' => 'ProfitSharingController@getYearWiseProfitExpense'
	]);


