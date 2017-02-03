<?php

Route::group(
    [
        'prefix' => config('macope.route_prefix'),
        'namespace' => 'Gallib\Macope\App\Http\Controllers',
        'middleware' => ['web']
    ],
    function() {
        Route::get('/import-file', [
            'uses' => 'ImportFileController@index'
        ])->name('importFile');

        Route::post('/import-file', [
            'uses' => 'ImportFileController@importFile'
        ]);

        Route::get('/journal', [
            'uses' => 'JournalController@index'
        ])->name('journal');

        Route::resource('accounts', 'AccountController');

        Route::resource('type-categories', 'TypeCategoryController');
    }
);
