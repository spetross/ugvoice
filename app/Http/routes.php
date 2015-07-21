<?php
//Theme::asset()->add('uikt', 'css/pace.css');
//Asset::add('pacejs', 'js/pace.min.js');
//Theme::asset()->container('footer')->add('form-serialize', 'library/sui/serialize-object.js', ['jquery']);
//Theme::asset()->container('footer')->add('uikit', 'assets/vendor/uikit/js/uikit.min.js', ['jquery']);
Theme::asset()->container('footer')->add('uikit-dropdown', 'assets/vendor/uikit/js/core/dropdown.js', ['core']);

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('home',  'HomeController@index');

Route::controller('auth', 'LoginController', [
    'getLogin' => 'login',
    'getSignup' => 'signup',
    'getLogout' => 'logout',
]);

//Site pages

Route::group(['middleware' => 'auth'], function () {

    Route::post('/refresh', 'HomeController@onRefresh');
    Route::match(['put', 'post'], 'file/upload', ['as' => 'file.upload', 'uses' => 'AssetController@store']);
    Route::post('file/meta', ['as' => 'file.config', 'uses' => 'AssetController@edit']);
    Route::post('file/sort', ['as' => 'files.sort', 'uses' => 'AssetController@sort']);
    Route::delete('file/{file}/remove', ['as' => 'file.delete', 'uses' => 'AssetController@destroy']);


    Route::get('user/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::get('messages/{user?}', ['as' => 'messages', 'uses' => 'MessageController@index']);
    Route::post('messages/{user}', ['as' => 'message.send', 'uses' => 'MessageController@onSend']);
    Route::get('user/privacy', ['as' => 'user.privacy', 'uses' => 'UserController@privacy']);
    Route::post('user/update', 'UserController@update');
    Route::get('user/{user}/profile', ['as' => 'user-profile', 'uses' => 'UserController@profile']);
    Route::get('user/{user?}', ['as' => 'user', 'uses' => 'UserController@profile']);

});

Route::get('clients', ['as' => 'clients', 'uses' => 'ClientsController@index']);


Route::group([
    'prefix' => '{client}',
    'where' => ['client' => '^[a-z0-9\-]+$'], // /^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i ^[a-z0-9\-]+$
], function () {

    require __DIR__ . "/client.php";

});