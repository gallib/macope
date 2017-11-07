<?php

Route::group(
    [
        'prefix' => config('macope.route_prefix'),
        'namespace' => 'Gallib\Macope\App\Http\Controllers',
        'middleware' => ['web']
    ],
    function() {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');

        Route::get('/expenses/{year?}', 'ExpenseController@index')
            ->name('expenses.index')
            ->where('year', '[0-9]+');

        Route::post('/expenses-last-sum/{months?}', 'ExpenseController@lastSum')
            ->name('expenses.lastsum')
            ->where('months', '[0-9]+');

        Route::get('/incomes/{year?}', 'IncomeController@index')
            ->name('incomes.index')
            ->where('year', '[0-9]+');

        Route::get('/import-file', 'ImportFileController@index')->name('import-file.index');

        Route::post('/import-file', 'ImportFileController@importFile')->name('import-file.import');

        Route::resource('/journal', 'JournalController');

        Route::post('/journal', 'JournalController@filter')
            ->name('journal.filter');

        Route::resource('accounts', 'AccountController');

        Route::resource('categorizations', 'CategorizationController');

        Route::resource('categories', 'CategoryController');

        Route::resource('type-categories', 'TypeCategoryController');
    }
);
