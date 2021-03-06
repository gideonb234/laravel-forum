<?php

Route::prefix(config('forum.web.prefix'))->middleware(config('forum.web.middleware'))->namespace(config('forum.web.namespace'))->name('forum.')->group(function () {
    Route::get('/', 'ForumController@index')->name('home');
    Route::post('search', 'ForumController@search')->name('search');

    Route::resource('groups', 'GroupController');
    Route::resource('discussions', 'DiscussionController');
    Route::resource('posts', 'PostController');

    Route::resource('lock', 'Discussion\LockController', [
        'only' => ['store', 'destroy'],
    ]);

    Route::resource('sticky', 'Discussion\StickyController', [
        'only' => ['store', 'destroy'],
    ]);
});
