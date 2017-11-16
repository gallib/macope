# Macope

Macope is a Laravel package to manage your online finance.

## Installation

Using Composer

```
composer require gallib/macope
```

then run

```
php artisan vendor:publish
php artisan migrate
```

next you have to register components by copying the following lines on `resources/assets/js/app.js`

```javascript
Vue.component(
    'macope-last-expenses',
    require('./components/macope/LastExpenses.vue')
);

Vue.component(
    'macope-expenses-by-type-category',
    require('./components/macope/ExpensesByTypeCategory.vue')
);
```
Macope is also using [laravel authentication](https://laravel.com/docs/authentication) to secure your data against visitors.

## Import files

For now, PostFinance and Migros Bank are supported.

### PostFinance

Once connected to your PostFinance account, go on the transaction page and click on export button.
Import this file on Macope and... that's all!

### Migros Bank

Once connected to your Migros Bank account, go on download statements under files transfer. On the first box, choose your account and select **.csv** as file format and click on download button.
Import this file on Macope and... that's all!

## Note

The package has been (basically) designed to work with [Bootstrap 4](https://v4-alpha.getbootstrap.com/). [Datatables](https://datatables.net/), [Chart.js](http://www.chartjs.org/) and [Moment.js](https://momentjs.com/) are also required if you want use default views.