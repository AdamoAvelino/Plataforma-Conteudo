<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];
Route::group($params, function() {
	Route::name('admin.modulo.')->group(function() {
		// modulo Controller
		Route::get('/modulo', 'ModuloController@index')->name('index');
		Route::get('/modulo/{id}/edit', 'ModuloController@edit')->name('edit');
		Route::get('/modulo/create', 'ModuloController@create')->name('create');
		Route::get('/modulo/{id}/show', 'ModuloController@show')->name('show');
		Route::post('/modulo/save', 'ModuloController@save')->name('save');
		Route::put('/modulo/{id}/update', 'ModuloController@update')->name('update');
		Route::delete('/modulo/{id}/delete', 'ModuloController@delete')->name('delete');
	});
});