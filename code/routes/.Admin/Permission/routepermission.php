<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];
Route::group($params, function() {
	Route::name('admin.permission.')->group(function() {
		// permission Controller
		Route::get('/permission', 'PermissionController@index')->name('index');
		Route::get('/permission/{id}/edit', 'PermissionController@edit')->name('edit');
		Route::get('/permission/create', 'PermissionController@create')->name('create');
		Route::get('/permission/{id}/show', 'PermissionController@show')->name('show');
		Route::post('/permission/save', 'PermissionController@save')->name('save');
		Route::put('/permission/{id}/update', 'PermissionController@update')->name('update');
		Route::delete('/permission/{id}/delete', 'PermissionController@delete')->name('delete');
	});
});