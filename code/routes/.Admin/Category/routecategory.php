<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.category.')->group(function() {
		// category Controller
		Route::get('/category', 'CategoryController@index')->name('index');
		Route::get('/category/{id}/edit', 'CategoryController@edit')->name('edit');
		Route::get('/category/create', 'CategoryController@create')->name('create');
		Route::get('/category/{id}/show', 'CategoryController@show')->name('show');
		Route::post('/category/save', 'CategoryController@save')->name('save');
		Route::put('/category/{id}/update', 'CategoryController@update')->name('update');
		Route::delete('/category/{id}/delete', 'CategoryController@delete')->name('delete');
	});
});