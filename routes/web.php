<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategorizationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ImportFileController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\TypeCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/expenses/{year?}', [ExpenseController::class, 'index'])
    ->name('expenses.index')
    ->where('year', '[0-9]+');

Route::post('/expenses-sum-by-month', [ExpenseController::class, 'sumByMonth'])
    ->name('expenses.sumbymonth');

Route::post('/expenses-by-type-category', [ExpenseController::class, 'expensesByTypeCategory'])
    ->name('expenses.by-type-category');

Route::get('/incomes/{year?}', [IncomeController::class, 'index'])
    ->name('incomes.index')
    ->where('year', '[0-9]+');

Route::post('/incomes-sum-by-month', [IncomeController::class, 'sumByMonth'])
    ->name('incomes.sumbymonth');

Route::get('/import-file', [ImportFileController::class, 'index'])->name('import-file.index');

Route::post('/import-file', [ImportFileController::class, 'importFile'])->name('import-file.import');

Route::resource('/journal', JournalController::class);

Route::post('/journal/sum-by-month', [JournalController::class, 'sumByMonth'])
    ->name('journal.sumbymonth');

Route::resource('accounts', AccountController::class);

Route::resource('categorizations', CategorizationController::class);

Route::resource('categories', CategoryController::class);

Route::resource('type-categories', TypeCategoryController::class);

Route::post('/monthly-expenses-type-category', [ExpenseController::class, 'monthlyExpensesByTypeCategory']);

Route::post('/monthly-expenses-category', [ExpenseController::class, 'monthlyExpensesByCategory']);

Auth::routes();
