<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.user.')->group(function() {
		// User Controller
		Route::get('/user', 'UserController@index')->name('index');
		Route::get('/user/{id}/edit', 'UserController@edit')->name('edit');
		Route::get('/user/create', 'UserController@create')->name('create');
		Route::get('/user/{id}/show', 'UserController@show')->name('show');
		Route::post('/user/save', 'UserController@save')->name('save');
		Route::put('/user/{id}/update', 'UserController@update')->name('update');
		Route::delete('/user/{id}/delete', 'UserController@delete')->name('delete');
	});
});