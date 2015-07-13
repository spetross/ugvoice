<?php
/**
 * Created by PhpStorm.
 * User: petross
 * Date: 6/21/15
 * Time: 3:47 PM
 */

Route::get('/', 'Admin\DashController@index');

Route::get('articles', 'Admin\ArticlesController@index');
Route::resource('article', 'Admin\ArticlesController',
    ['except' => ['index', 'show']]);

Route::get('groups', 'Admin\GroupsController@index');
Route::resource('group', 'Admin\GroupsController',
    ['except' => ['index', 'show']]);


Route::get('login', function () {
    return redirect()->action('Admin\DashController@login');
});
Route::any('signin', 'Admin\DashController@login');
Route::get('logout.php', 'Admin\DashController@logout');

Route::get('organisations', 'Admin\OrganisationsController@index');
//Route::post('organisation/{organisation}/edit', 'OrganisationsController@update');
Route::resource('organisation', 'Admin\OrganisationsController',
    ['except' => ['index']]);

Route::get('users', 'Admin\UsersController@index');
Route::resource('user', 'Admin\UsersController',
    ['except' => ['index', 'edit']]);


