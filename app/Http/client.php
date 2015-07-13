<?php


Route::get('/', [
    'as' => 'client.home', 'uses' => 'Clients\ClientController@home'
]);

Route::any('about', [
    'as' => 'client.about', 'uses' => 'Clients\ClientController@about'
]);

Route::any('articles', [
    'as' => 'client.articles', 'uses' => 'Clients\ClientController@articles'
]);

Route::any('contacts', [
    'as' => 'client.contacts', 'uses' => 'Clients\ClientController@contacts'
]);

Route::post('/', 'Clients\PostsController@index');

Route::post('posts', 'Clients\PostsController@posts');

Route::post('post/add', [
    'as' => 'client.post.store', 'uses' => 'Clients\PostsController@onPost'
]);

Route::get('post/{id}', [
    'as' => 'client.post.show', 'uses' => 'Clients\PostsController@show'
]);


Route::post('post/{id}', [
    'as' => 'client.post.comment', 'uses' => 'Clients\PostsController@onComment'
]);

Route::get('post/{id}/comments', function ($client, $postId) {
    $post = $client->posts()->getQuery()->find($postId);
    $comments = $post->comments()->getQuery()->paginate(6);
    return view('client.posts.comments', compact('post', 'comments'))->render();
});

Route::post('post/{id}/comments', function ($client, $postId) {
    $response = [];
    /** @var \app\Post $post */
    $post = $client->posts()->getQuery()->find($postId);
    $comments = $post->comments()->getQuery()->paginate(6);
    if ($comments->hasMorePages())
        $response['nextPage'] = $comments->currentPage() + 1;
    $response['success'] = true;
    $response['Comments'] = [];
    foreach ($comments as $comment) {
        array_push($response['Comments'], view('client.posts.comment', compact('comment'))->render());
    }
    return $response;
});


Route::delete('post/{id}', function ($client, $id) {
    $post = $client->posts()->getQuery()->find($id);
    $post->delete();
    return ['success' => true];
});

Route::delete('comment/{id}', function ($client, $id) {
    $comment = \app\Comment::find($id);
    $comment->delete();
    return ['success' => true];
});

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

    Route::get('/timeline', [
        'as' => 'client.timeline',
        'uses' => 'Clients\PostsController@index'
    ]);


});
