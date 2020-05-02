# Connectly

[![Build Status](https://img.shields.io/travis/crudly/Connectly/master?style=flat-square)](https://travis-ci.org/crudly/connectly)
[![Release](https://img.shields.io/github/v/release/crudly/Connectly?style=flat-square)](https://github.com/crudly/connectly/releases/latest)
[![License](https://img.shields.io/github/license/crudly/Connectly?style=flat-square)](LICENSE)

Store database connections on the database :) Everything encrypted.

```php
$connectly = Connectly::create([
	'name' => 'My connection',
	'config' => [
		'driver' => 'mysql',
		'host' => '127.0.0.1',
		'port' => '3306',
		'database' => 'connectly_test_base',
		'username' => 'connectly_user',
		'password' => 'hunter2',
	],
]);

$myCon = Connectly::where('name', 'My connection')->first();

$connection = $myCon->connect();   // This is a Laravel DB connection

$connection->table('users')->get();
```

## Installation

Use composer.

```bash
$ composer require crudly/connectly
```

## Usage

Store a config for a Laravel DB connection in the `config` property. Laravel's default `config/database.php` contains some examples and [here](https://laravel.com/docs/7.x/database#configuration) is a more thorough description.

```php
<?php

use Crudly\Connectly\Connectly;

// ...

$newConnection = new Connectly;

$newConnection->name = 'My other database';

$newConnection->config = [
	'driver' => 'mysql',
	'host' => '127.0.0.1',
	'port' => '3306',
	'database' => 'connectly_test_base',
	'username' => 'connectly_user',
	'password' => 'hunter2',
];

$newConnection->save();
```

`Connectly` is an Eloquent model, you can store and retrieve it as such.

```php
<?php

use Crudly\Connectly\Connectly;

// ...

$storedConnectly = Connectly::latest()->first();

//or
$myConnection = Connectly::where('name', 'My other database')->first();
```

You can use an instance to pop up a new DB connection instance and use it with query builder.

```php
$connection = $myConnection->connect();

$data = $connection->table('posts')->get();
```
