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

        Route::get('/account', [
            'uses' => 'AccountController@index'
        ])->name('account');

        Route::post('/account', [
            'uses' => 'AccountController@add'
        ]);
    }
);
