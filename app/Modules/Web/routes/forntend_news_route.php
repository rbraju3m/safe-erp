

<?php

    Route::get('/','WebController@index');
	
	Route::get('frontend-singel-news/{id}', [
		'as' => 'frontend.singel.news',
		'uses' => 'WebController@singel_news'
	]);

	Route::get('frontend-category-news/{id}', [
		'as' => 'frontend.category.news',
		'uses' => 'WebController@category_news'
	]);

	
?>