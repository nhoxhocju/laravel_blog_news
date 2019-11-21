<?php
use App\Article;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
//     Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
//     // list all lfm routes here...
// });
Auth::routes();
Route::get('lang/{locale}', 'LocalizationController@index')->name('localization.index');

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/post/{slug}', 'HomeController@show')->name('home.show');
});

Route::group(['namespace' => 'Backend', 'middleware' => 'auth', 'as' => 'backend.', 'prefix' => 'dashboard'], function() {
    Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
        Route::get('/', 'PostsController@index')->name('index');
        Route::get('create', 'PostsController@create')->name('create');
        Route::post('store', 'PostsController@store')->name('store');
        Route::get('edit/{id}', 'PostsController@edit')->name('edit');
        Route::put('update/{id}', 'PostsController@update')->name('update');
        Route::delete('delete/{id}', 'PostsController@delete')->name('delete');
        Route::delete('delete_checkbox', 'PostsController@deleteCheckbox')->name('deleteCheckbox');
    });

    Route::group(['prefix' => 'languages', 'as' => 'language.'], function () {
        Route::get('/', 'LanguagesController@index')->name('index');
        Route::get('create', 'LanguagesController@create')->name('create');
        Route::post('store', 'LanguagesController@store')->name('store');
    });

    Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
        Route::get('/', 'CategoriesController@index')->name('index');
        Route::get('create', 'CategoriesController@create')->name('create');
        Route::post('store', 'CategoriesController@store')->name('store');
        Route::get('edit/{id}', 'CategoriesController@edit')->name('edit');
        Route::put('update/{id}', 'CategoriesController@update')->name('update');
        Route::delete('delete/{id}', 'CategoriesController@delete')->name('delete');
        Route::delete('delete_checkbox', 'CategoriesController@deleteCheckbox')->name('deleteCheckbox');
    });

    Route::group(['prefix' => 'galleries', 'as' => 'gallery.'], function () {
        Route::get('/', 'GalleriesController@index')->name('index');
        // Route::get('create', 'LanguagesController@create')->name('create');
        // Route::post('store', 'LanguagesController@store')->name('store');
    });
});


// Route::get('/admin', 'Admin\PostsController@index')->name('posts');
// // Route::get('/admin', 'Admin\PostsController@index');
// Route::get('/admin/create', 'Admin\PostsController@create')->name('create_post');
// Route::post('/admin/create', 'Admin\PostsController@store');
// Route::get('/admin/edit/{id}', 'Admin\PostsController@edit');
// Route::put('/admin/edit/{id}', 'Admin\PostsController@update');
// Route::delete('/admin/delete/{id}', 'Admin\PostsController@delete');
// Route::get('/single_post/{id}', 'HomeController@show');
// Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

// Route::get('/admin/languages/', 'Admin\LanguagesController@index')->name('languages');
// Route::get('/admin/languages/create', 'Admin\LanguagesController@create')->name('create_language');

// Route::get('{locale}', 'ArticlesController@index');
// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/admin', 'AdminController@index');
