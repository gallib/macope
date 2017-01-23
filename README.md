#Macope

## Installations

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