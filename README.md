# Macope

Macope is a Laravel application to manage your online finance.

## Installation

Using Composer

```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## Import files

For now, PostFinance and Migros Bank are supported.

### PostFinance

Once connected to your PostFinance account, go on the transaction page and click on export button.
Import this file on Macope and... that's all!

### Migros Bank

Once connected to your Migros Bank account, go on download statements under files transfer. On the first box, choose your account and select **.csv** as file format and click on download button.
Import this file on Macope and... that's all!
