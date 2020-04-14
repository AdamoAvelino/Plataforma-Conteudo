<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.status.')->group(function() {
		// status Controller
		Route::get('/status', 'StatusController@index')->name('index');
		Route::get('/status/{id}/edit', 'StatusController@edit')->name('edit');
		Route::get('/status/create', 'StatusController@create')->name('create');
		Route::get('/status/{id}/show', 'StatusController@show')->name('show');
		Route::post('/status/save', 'StatusController@save')->name('save');
		Route::put('/status/{id}/update', 'StatusController@update')->name('update');
		Route::delete('/status/{id}/delete', 'StatusController@delete')->name('delete');
	});
});