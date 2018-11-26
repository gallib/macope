<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Expenses
Breadcrumbs::for('expenses.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Expenses', route('expenses.index'));
});

// Incomes
Breadcrumbs::for('incomes.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Incomes', route('incomes.index'));
});

// Import files
Breadcrumbs::for('import-file.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Import files', route('import-file.index'));
});

// Journal
Breadcrumbs::for('journal.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Journal', route('journal.index'));
});

Breadcrumbs::for('journal.edit', function ($trail, $journal) {
    $trail->parent('journal.index');
    $trail->push('Edit', route('journal.edit', $journal->id));
});

// Accounts
Breadcrumbs::for('accounts.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Accounts', route('accounts.index'));
});

Breadcrumbs::for('accounts.show', function ($trail, $account) {
    $trail->parent('accounts.index');
    $trail->push('View details', route('accounts.show', $account->id));
});

Breadcrumbs::for('accounts.create', function ($trail) {
    $trail->parent('accounts.index');
    $trail->push('Add', route('accounts.create'));
});

Breadcrumbs::for('accounts.edit', function ($trail, $account) {
    $trail->parent('accounts.index');
    $trail->push('Edit', route('accounts.edit', $account->id));
});

// Categorizations
Breadcrumbs::for('categorizations.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Categorizations', route('categorizations.index'));
});

Breadcrumbs::for('categorizations.show', function ($trail, $categorization) {
    $trail->parent('categorizations.index');
    $trail->push('View details', route('categorizations.show', $categorization->id));
});

Breadcrumbs::for('categorizations.create', function ($trail) {
    $trail->parent('categorizations.index');
    $trail->push('Add', route('categorizations.create'));
});

Breadcrumbs::for('categorizations.edit', function ($trail, $categorization) {
    $trail->parent('categorizations.index');
    $trail->push('Edit', route('categorizations.edit', $categorization->id));
});

// Categories
Breadcrumbs::for('categories.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Categories', route('categories.index'));
});

Breadcrumbs::for('categories.show', function ($trail, $category) {
    $trail->parent('categories.index');
    $trail->push('View details', route('categories.show', $category->id));
});

Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories.index');
    $trail->push('Add', route('categories.create'));
});

Breadcrumbs::for('categories.edit', function ($trail, $category) {
    $trail->parent('categories.index');
    $trail->push('Edit', route('categories.edit', $category->id));
});

// Type categories
Breadcrumbs::for('type-categories.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Type categories', route('type-categories.index'));
});

Breadcrumbs::for('type-categories.show', function ($trail, $typeCategory) {
    $trail->parent('type-categories.index');
    $trail->push('View details', route('type-categories.show', $typeCategory->id));
});

Breadcrumbs::for('type-categories.create', function ($trail) {
    $trail->parent('type-categories.index');
    $trail->push('Add', route('type-categories.create'));
});

Breadcrumbs::for('type-categories.edit', function ($trail, $typeCategory) {
    $trail->parent('type-categories.index');
    $trail->push('Edit', route('type-categories.edit', $typeCategory->id));
});
