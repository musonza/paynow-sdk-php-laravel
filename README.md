[![Build Status](https://travis-ci.org/musonza/paynow-sdk-php-laravel.svg?branch=master)](https://travis-ci.org/musonza/paynow-sdk-php-laravel)

## Introduction

A Laravel 5 service provider for the Paynow SDK for PHP

See https://github.com/paynow/Paynow-PHP-SDK

## Installation

Composer install - from the command line, run:

```
composer require musonza/paynow-sdk-php-laravel
```

Publish config file:

```
php artisan vendor:publish
```

## Configuration

Config file will be published on config path as `paynow.php`

```php
<?php

return [
    'integration_id' => env('PAYNOW_INTEGRATION_ID'),
    'integration_key' => env('PAYNOW_INTEGRATION_KEY'),
    'return_url' => env('PAYNOW_RETURN_URL', 'http://example.com/gateways/paynow/update'),
    'result_url' => env('PAYNOW_RESULT_URL', 'http://example.com/return?gateway=paynow'),
];

```

## Usage

You can use the Paynow facade as below:

```php
<?php

// Returns Paynow\Payments\FluentBuilder
$payment = Paynow::createPayment('Invoice 35', 'user@example.com');

```
