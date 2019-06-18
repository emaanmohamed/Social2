<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}' ,  ['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

Route::post('doLogin', 'HomeController@login')->name('doLogin');

Route::group(['middleware'=> 'admin'], function (){
    Route::get('/admin', function (){
       return view('admin.index');
    });

    Route::resource('admin/users', 'AdminUsersController');
    Route::get('admin/posts', 'AdminPostsController@index');
    Route::get('admin/posts/create', 'AdminPostsController@create');
    Route::post('admin/posts', 'AdminPostsController@store');
    Route::patch('admin/posts/{id}', 'AdminPostsController@update');
    Route::delete('admin/posts/{id}', 'AdminPostsController@destroy');
    Route::get('admin/posts/edit/{id}', 'AdminPostsController@edit')->name('admin.posts.edit');
    Route::get('admin/categories', 'AdminCategoriesController@index');
    Route::post('admin/categories', 'AdminCategoriesController@store');
    Route::get('admin/categories/create', 'AdminCategoriesController@create');
    Route::patch('admin/categories/{id}', 'AdminCategoriesController@update');
    Route::get('admin/categories/{id}/edit', 'AdminCategoriesController@edit')->name('admin.categories.edit');
    Route::delete('admin/categories/{id}', 'AdminCategoriesController@destroy');
    Route::get('admin/media', 'AdminMediaController@index');
    Route::get('admin/media/create', 'AdminMediaController@create');
    Route::post('admin/media', 'AdminMediaController@store');
    Route::delete('admin/media/{id}', 'AdminMediaController@destroy');
    Route::get('admin/comments', 'PostCommentsController@index')->name('admin.comments.index');
    Route::get('admin/comment/replies', 'CommentRepliesController@index');
    Route::post('admin/comments', 'PostCommentsController@store');
    Route::patch('admin/comments/{id}', 'PostCommentsController@update');
    Route::delete('admin/comments/{id}', 'PostCommentsController@destroy');
    Route::get('admin/comments/{id}', 'PostCommentsController@show')->name('admin.comments.show');
    Route::get('admin/comments/replies', 'CommentRepliesController@index');
    Route::post('admin/comments/replies', 'CommentRepliesController@store');
    Route::patch('admin/comments/replies/{id}', 'CommentRepliesController@update');
    Route::get('admin/comments/replies/{id}', 'CommentRepliesController@destroy');
    Route::get('admin/comments/replies', 'CommentRepliesController@edit');
    Route::get('admin/comments/replies', 'CommentRepliesController@create');
});

Route::group(['middleware'=> 'auth'], function (){
    Route::post('comment/reply', 'CommentRepliesController@createReply');
});





