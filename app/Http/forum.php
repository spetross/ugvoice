<?php

Route::get('/', 'Forum\IndexController@index');

Route::resource('topic', 'Forum\TopicsController');