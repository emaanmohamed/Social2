<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function (){

    return view('admin.index');
});

Route::post('doLogin', 'HomeController@login')->name('doLogin');

Route::group(['middleware'=> 'admin'], function (){

    Route::resource('admin/users', 'AdminUsersController');
    Route::get('admin/posts', 'AdminPostsController@index');
    Route::get('admin/posts/create', 'AdminPostsController@create');
    Route::post('admin/posts', 'AdminPostsController@store');
    Route::patch('admin/posts/{id}', 'AdminPostsController@update');
    Route::delete('admin/posts/{id}', 'AdminPostsController@destroy');
    Route::get('admin/posts/edit/{id}', 'AdminPostsController@edit')->name('admin.posts.edit');

});




