<?php


Route::get('/', [
    'as' => 'client-home',
    'uses' => 'Client\PageController@home'
]);

Route::any('about', [
    'as' => 'about-client',
    'uses' => 'Client\PageController@about'
]);

Route::any('articles', [
    'as' => 'client-articles',
    'uses' => 'Client\PageController@articles'
]);

Route::any('contacts', [
    'as' => 'client-contacts',
    'uses' => 'Client\PageController@contacts'
]);

Route::post('/', [
    'as' => 'get-client-posts',
    'uses' => 'Client\PostController@index'
]);

Route::post('posts', [
    'as'    => 'post.add',
    'uses'  => 'Client\PostController@onPost'
]);

Route::get('posts/{post}', [
    'as'    => 'show-post',
    'uses'  => 'Client\PostController@show'
]);

Route::put('posts/{post}', [
    'as' => 'add-post-comment',
    'uses' => 'Client\PostController@onComment'
]);

Route::get('posts/{post}/comments', [
    'as' => 'get-post-comments',
    'uses' => 'Client\PostController@getComments'
]);

Route::put('posts/{post}/edit', [
    'as' => 'edit-post',
    'uses' => 'Client\PostController@onEdit'
]);


Route::delete('post/{post}', [
    'as'    => 'delete-post',
    'uses'  => 'Client\PostController@deletePost'
]);

Route::delete('post/{post}/comment/{comment}', [
    'as' => 'delete-comment',
    'uses' => 'Client\PostController@deleteComment'
]);

Route::get('/articles', [
    'as' => 'client.articles',
    'uses' => 'Clients\ArticleController@index'
]);

Route::get('/article/create', [
    'as' => 'client.article.create',
    'uses' => 'Clients\ArticleController@create'
]);

Route::post('/article/store', [
    'as' => 'client.article.store',
    'uses' => 'Clients\ArticleController@store'
]);

Route::get('/article/{id}/edit', [
    'as' => 'client.article.edit',
    'uses' => 'Clients\ArticleController@edit'
]);


Route::post('/article/{id}/edit', [
    'as' => 'client.article.update',
    'uses' => 'Clients\ArticleController@update'
]);

Route::delete('/article/{id}', [
    'as' => 'client.article.delete',
    'uses' => 'Clients\ArticleController@destroy'
]);

Route::group([
    'prefix' => 'cp'
], function () {

    Route::get('/dashboard', [
        'as' => 'client.dashboard',
        'uses' => 'Clients\AdminController@dashboard'
    ]);


    Route::get('/counselors', [
        'as' => 'client.counselors',
        'uses' => 'Clients\PersonController@index'
    ]);


    Route::get('/counselor/add', [
        'as' => 'client.counselor.add',
        'uses' => 'Clients\PersonController@add'
    ]);

    Route::post('/counselor/add', [
        'as' => 'client.counselor.store',
        'uses' => 'Clients\PersonController@store'
    ]);

    Route::get('/counselor/{id}/edit', [
        'as' => 'client.counselor.edit',
        'uses' => 'Clients\PersonController@edit'
    ]);

    Route::post('/counselor/{id}/edit', [
        'as' => 'client.counselor.update',
        'uses' => 'Clients\PersonController@update'
    ]);

    Route::get('/counselor/{id}', [
        'as' => 'client.counselor.view',
        'uses' => 'Clients\PersonController@show'
    ]);

    Route::delete('/counselor/{id}', [
        'as' => 'client.counselor.delete',
        'uses' => 'Clients\PersonController@destroy'
    ]);

});
