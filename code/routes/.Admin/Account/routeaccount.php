<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.account.')->group(function() {
		// account Controller
		Route::get('/account', 'AccountController@index')->name('index');
		Route::get('/account/{id}/edit', 'AccountController@edit')->name('edit');
		Route::get('/account/create', 'AccountController@create')->name('create');
		Route::get('/account/{id}/show', 'AccountController@show')->name('show');
		Route::post('/account/save', 'AccountController@save')->name('save');
		Route::put('/account/{id}/update', 'AccountController@update')->name('update');
		Route::delete('/account/{id}/delete', 'AccountController@delete')->name('delete');
	});
});