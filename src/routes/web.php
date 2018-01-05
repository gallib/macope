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

        Route::post('/expenses-sum-by-month', 'ExpenseController@sumByMonth')
            ->name('expenses.sumbymonth');

        Route::post('/expenses-by-type-category/{months?}', 'ExpenseController@expensesByTypeCategory')
            ->name('expenses.by-type-category')
            ->where('months', '[0-9]+');

        Route::get('/incomes/{year?}', 'IncomeController@index')
            ->name('incomes.index')
            ->where('year', '[0-9]+');

        Route::post('/incomes-sum-by-month', 'IncomeController@sumByMonth')
            ->name('incomes.sumbymonth');

        Route::get('/import-file', 'ImportFileController@index')->name('import-file.index');

        Route::post('/import-file', 'ImportFileController@importFile')->name('import-file.import');

        Route::resource('/journal', 'JournalController');

        Route::post('/journal/sum-by-month', 'JournalController@sumByMonth')
            ->name('journal.sumbymonth');

        Route::resource('accounts', 'AccountController');

        Route::resource('categorizations', 'CategorizationController');

        Route::resource('categories', 'CategoryController');

        Route::resource('type-categories', 'TypeCategoryController');
    }
);
