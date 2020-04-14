<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.produce.')->group(function() {
		// produce Controller
		Route::get('/produce', 'ProduceController@index')->name('index');
		Route::get('/produce/{id}/edit', 'ProduceController@edit')->name('edit');
		Route::get('/produce/create', 'ProduceController@create')->name('create');
		Route::get('/produce/{id}/show', 'ProduceController@show')->name('show');
		Route::post('/produce/save', 'ProduceController@save')->name('save');
		Route::put('/produce/{id}/update', 'ProduceController@update')->name('update');
		Route::delete('/produce/{id}/delete', 'ProduceController@delete')->name('delete');
	});
});