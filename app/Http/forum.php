<?php

Route::get('/', ['as' => 'forum', 'uses' => 'Forum\IndexController@index']);

Route::resource('topic', 'Forum\TopicsController');