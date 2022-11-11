# laravel-uuid
Eloquent UUID Trait for Laravel 5.7 and above.

⚠️ This package will no longer be maintained. [The HasUuids feature has been added in Laravel 9.](https://laravel.com/docs/9.x/eloquent#uuid-and-ulid-keys)

[![Github Actions](https://img.shields.io/github/workflow/status/JamesHemery/laravel-uuid/Continuous%20Integration.svg?style=for-the-badge)](https://github.com/JamesHemery/laravel-uuid/actions?query=workflow%3A%22Continuous+Integration%22)
[![Total Downloads](https://img.shields.io/packagist/dt/jamesh/laravel-uuid.svg?style=for-the-badge)](https://packagist.org/packages/jamesh/laravel-uuid)
[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg?style=for-the-badge)](https://raw.githubusercontent.com/JamesHemery/laravel-uuid/master/LICENSE)

The HasUuid Trait will add behavior to creating and saving Eloquent events for generate an Uuid.

## Installation

	composer require jamesh/laravel-uuid

## Usage

#### In your migrations

```php
Schema::create('users', function (Blueprint $table) {
    $table->uuid('id')->primary(); // Create CHAR(36)
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

#### In your models

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jamesh\Uuid\HasUuid;

class User extends Model
{
    use HasUuid;
}
```

## Unit tests

To run the tests, just run `composer install` and `composer test`.
