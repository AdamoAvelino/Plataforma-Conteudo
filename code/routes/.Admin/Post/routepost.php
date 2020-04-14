<?php

$params = ['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'];

Route::group($params, function() {
	Route::name('admin.post.')->group(function() {
		// post Controller
		Route::get('/post', 'PostController@index')->name('index');
		Route::get('/post/{id}/edit', 'PostController@edit')->name('edit');
		Route::get('/post/create', 'PostController@create')->name('create');
		Route::get('/post/{id}/show', 'PostController@show')->name('show');
		Route::post('/post/save', 'PostController@save')->name('save');
		Route::put('/post/{id}/update', 'PostController@update')->name('update');
		Route::delete('/post/{id}/delete', 'PostController@delete')->name('delete');
	});
});