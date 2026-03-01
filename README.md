# PEST PLUGIN DATABASE

A pest plugin to test your database structure.

[![Tests](https://github.com/faissaloux/pest-plugin-database/actions/workflows/tests.yml/badge.svg)](https://github.com/faissaloux/pest-plugin-database/actions/workflows/tests.yml)
![Packagist Version](https://img.shields.io/packagist/v/faissaloux/pest-plugin-database)
[![Total Downloads on Packagist](https://img.shields.io/packagist/dt/faissaloux/pest-plugin-database.svg?style=flat-square)](https://packagist.org/packages/faissaloux/pest-plugin-database)
![Packagist License](https://img.shields.io/packagist/l/faissaloux/pest-plugin-database)

## Requirements

- php ^8.2
- pestphp ^3.0 | ^4.0
- Laravel ^11.0 | ^12.0

## Installation
```bash
composer require faissaloux/pest-plugin-database --dev
```

## Supported Drivers
- Mysql
- Sqlite

## Expectations
Check driver.
```php
expect()->driver->toBe('mysql');
```

Check database name.
```php
expect()->database->toBe('database');
```

Check tables in your database.
```php
expect()->database->toContainTables(['users', 'posts']);
```

Check number of tables in your database.
```php
expect()->database->toContainTablesCount(9);
```

## Support

If you encounter any issues or have questions, feel free to open an issue on this repository's [Issues page](https://github.com/faissaloux/pest-plugin-database/issues). I'll try to respond as soon as possible.
