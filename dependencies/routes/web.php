<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('maqe', 'PostController@index');

Route::prefix('MRTA-backend/console')->group(function (){
    Auth::routes();


    Route::get('email', function (){
        return view('email');
    });

    //Dashboard
    Route::get('dashboard', 'HomeController@index')->name('dashboard');

    //News
    Route::prefix('news')->group(function (){
        Route::resource('news-categories', 'NewsCategoryController');
        Route::post('news-categories/destroymany', 'NewsCategoryController@destroyMany')->name('news_category_destroymany');
    });
    Route::resource('news', 'NewsController');
    Route::post('news/destroymany', 'NewsController@destroyMany')->name('news_destroymany');
    Route::get('news/category-set', 'NewsController@setCategory')->name('news_typeset');

    //Pages
    Route::resource('pages', 'PagesController');
    Route::post('pages/destroymany', 'PagesController@destroyMany')->name('pages_destroymany');

    //Menus
    Route::resource('menus', 'MenusController');

    //Media
    Route::put('media/uploads', 'MediaController@upload')->name('media_upload');
    Route::resource('media', 'MediaController');

    //Construct
    Route::get('construct/update/status/{id}', 'ConstructController@update_status')->name('construct_update_status');
    Route::resource('stations', 'StationController');
    //Stations
    Route::post('stations/destroymany', 'StationController@destroyMany')->name('stations_destroymany');
    Route::prefix('construct')->group(function (){

        //Folder
        Route::resource('pictures', 'ConstructPictureController');

        //Uploads
        Route::put('uploads/{id}', 'ConstructImageController@upload')->name('uploads_progress');

        //Uploads
        Route::delete('uploads/{id}', 'ConstructImageController@destroy')->name('uploads_delete');

        //Percent Update
        Route::resource('percent', 'ConstructPercentController');

    });

    //Construct
    Route::resource('construct', 'ConstructController');
    Route::post('construct/destroymany', 'ConstructController@destroyMany')->name('construct_destroymany');

    //Settings
    Route::prefix('settings')->group(function (){
        //Users
        Route::resource('users', 'UserController');
        Route::post('users/destroymany', 'UserController@destroyMany')->name('users_destroymany');


        //Roles
        Route::resource('roles', 'RoleController');
        Route::post('roles/destroymany', 'RoleController@destroyMany')->name('roles_destroymany');


        //Generals
        Route::resource('generals', 'GeneralController');

        //Email
        Route::resource('email', 'EmailController');

        //Permission
        Route::resource('permissions', 'PermissionController');
        Route::post('permissions/destroymany', 'PermissionController@destroyMany')->name('permission_destroymany');

        //Default Status
        Route::resource('statuses', 'StatusController');

        //Languages
        Route::resource('languages', 'LanguageController');
        Route::post('languages/destroymany', 'LanguageController@destroyMany')->name('language_destroymany');
        Route::get('languages/makedefault/{id}', 'LanguageController@makeDefault')->name('languages_makedefault');

    });


});
