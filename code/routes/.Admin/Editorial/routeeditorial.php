<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.editorial.')->group(function() {
		// editorial Controller
		Route::get('/editorial', 'EditorialController@index')->name('index');
		Route::get('/editorial/{id}/edit', 'EditorialController@edit')->name('edit');
		Route::get('/editorial/create', 'EditorialController@create')->name('create');
		Route::get('/editorial/{id}/show', 'EditorialController@show')->name('show');
		Route::post('/editorial/save', 'EditorialController@save')->name('save');
		Route::put('/editorial/{id}/update', 'EditorialController@update')->name('update');
		Route::delete('/editorial/{id}/delete', 'EditorialController@delete')->name('delete');
	});
});