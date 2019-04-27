# laravel-uuid
Eloquent UUID Trait for Laravel 5.7 and 5.8.

[![MIT licensed](https://img.shields.io/badge/license-MIT-green.svg)](https://raw.githubusercontent.com/JamesHemery/laravel-uuid/master/LICENSE)
[![Travis](https://img.shields.io/travis/JamesHemery/laravel-uuid.svg)](https://travis-ci.org/JamesHemery/laravel-uuid)

The HasUuid Trait will add behavior to creating and saving Eloquent events for generate an Uuid.

## Installation

	composer require jamesh/eloquent-uuid

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