#Macope

Macope is a Laravel A package to manage your online finance.

## Installation

Using Composer

```
composer require gallib/macope
```

Add the service provider to `config/app.php`

```php
'providers' => [
    // ...
    Gallib\Macope\MacopeServiceProvider::class,
]
```

then run

```
php artisan vendor:publish
```

Macope is also using [laravel authentication](https://laravel.com/docs/5.4/authentication) to secure your data against visitors.

## Import files

For now, only PostFinance is supported.

### PostFinance

Once connected to your PostFinance account, go on the transaction page and click on export button.
Import this file on Macope and... that's all!

## Note

The package has been (basically) designed to work with [Bootstrap 4](https://v4-alpha.getbootstrap.com/). [Datatables](https://datatables.net/) and [Moment.js](https://momentjs.com/) are also required if you want use default views.