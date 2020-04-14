<?php


Auth::routes();
Route::get('/', function () {
    return view('site.index');
});


Route::group(['prefix' => 'admin'], function () {
    //Admin Controller
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/sections/{name}', 'HomeController@sections')->name('admin.sections');
});

Route::get('/home', 'HomeController@index')->name('home');

/// será deletado
Route::get('/show-post/{id}', 'HomeController@showPost')->name('home.show-post');
Route::get('/permission-debug', 'HomeController@permissionDebug');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
