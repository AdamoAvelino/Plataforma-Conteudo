<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.account_class.')->group(function() {
		// account_class Controller
		Route::get('/account_class', 'AccountClassController@index')->name('index');
		Route::get('/account_class/{id}/edit', 'AccountClassController@edit')->name('edit');
		Route::get('/account_class/create', 'AccountClassController@create')->name('create');
		Route::get('/account_class/{id}/show', 'AccountClassController@show')->name('show');
		Route::post('/account_class/save', 'AccountClassController@save')->name('save');
		Route::put('/account_class/{id}/update', 'AccountClassController@update')->name('update');
		Route::delete('/account_class/{id}/delete', 'AccountClassController@delete')->name('delete');
	});
});