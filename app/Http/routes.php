<?php
//Theme::asset()->add('uikt', 'css/pace.css');
//Asset::add('pacejs', 'js/pace.min.js');
//Theme::asset()->container('footer')->add('form-serialize', 'library/sui/serialize-object.js', ['jquery']);
Theme::asset()->container('footer')->add('uikit', 'assets/vendor/uikit/js/uikit.min.js', ['jquery']);
Theme::asset()->container('footer')->add('uikit-grid', 'assets/vendor/uikit/js/components/grid.js', ['uikit']);

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::controller('auth', 'LoginController');

//Site pages

Route::group(['middleware' => 'auth'], function () {

    Route::post('/refresh', 'HomeController@onRefresh');
    Route::match(['put', 'post'], 'file/upload', ['as' => 'file.upload', 'uses' => 'AssetController@store']);
    Route::post('file/meta', ['as' => 'file.config', 'uses' => 'AssetController@edit']);
    Route::post('file/sort', ['as' => 'files.sort', 'uses' => 'AssetController@sort']);
    Route::delete('file/{file}/remove', ['as' => 'file.delete', 'uses' => 'AssetController@destroy']);


    Route::get('user', ['as' => 'user', 'uses' => 'UserController@profile']);
    Route::get('user/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::get('user/messages', ['as' => 'messages', 'uses' => 'MessageController@index']);
    Route::get('user/privacy', ['as' => 'user.privacy', 'uses' => 'UserController@privacy']);
    Route::post('user/update', 'UserController@update');

});

Route::get('clients', ['as' => 'clients.index', 'uses' => 'Clients\IndexController@index']);

Route::bind('client', function ($value) {
    return app('app\\Repositories\\OrganisationRepository')->findBySlug($value);
});

Route::group([
    'prefix' => '{client}',
    'where' => ['client' => '^[a-z0-9-]+$'], // /^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i
], function () {

    require __DIR__ . "/client.php";

});