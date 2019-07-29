<?php





// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/','PagesController@index')->name('home');
Route::get('/blog','PagesController@blog')->name('blog');
Route::resource('posts','PostsController');

Route::group(['prefix'=>'admin','namespace' => 'Admin', 'middleware'=>'auth'], function (){
	Route::get('','AdminController@index')->name('admin.home')->middleware('auth');
    Route::get('posts','PostsController@index')->name('admin.posts.index');
    Route::get('posts/create','PostsController@create')->name('admin.posts.create');
    Route::post('posts','PostsController@store')->name('admin.posts.store');
    Route::get('posts/{post}/edit','PostsController@edit')->name('admin.posts.edit');
    Route::put('posts/{post}','PostsController@update')->name('admin.posts.update');
    Route::delete('posts/{post}','PostsController@destroy')->name('admin.posts.destroy');
    Route::post('posts/{post}/photos','PhotosController@store')->name('admin.posts.photos.store');
});