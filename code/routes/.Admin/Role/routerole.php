<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.role.')->group(function() {
		// role Controller
		Route::get('/role', 'RoleController@index')->name('index');
		Route::get('/role/{id}/edit', 'RoleController@edit')->name('edit');
		Route::get('/role/create', 'RoleController@create')->name('create');
		Route::get('/role/{id}/show', 'RoleController@show')->name('show');
		Route::post('/role/save', 'RoleController@save')->name('save');
		Route::put('/role/{id}/update', 'RoleController@update')->name('update');
		Route::delete('/role/{id}/delete', 'RoleController@delete')->name('delete');
	});
});