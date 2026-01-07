# Laravel 12.45 ResourceCollection Bug Reproduction

This repository reproduces a bug in Laravel 12.45 where `ResourceCollection` throws an error when initialized with a plain array.

## Issue

After upgrading from Laravel 12.44 to 12.45, `ResourceCollection` throws the following error:
```
Call to a member function resolve() on array
```

**Related Issue:** https://github.com/laravel/framework/issues/58297

## What Changed

The bug appears to be introduced by PR #57571 which changed the `toArray()` method in `ResourceCollection`:

**Before (12.44):**
```php
return $this->collection->map->toArray($request)->all();
```

**After (12.45):**
```php
return $this->collection->map->resolve($request)->all();
```

## Requirements

- PHP 8.4
- Composer
- Laravel 12.45

## Installation
```bash
composer install
cp .env.example .env
php artisan key:generate
```

## Reproduction Steps

1. Install dependencies
2. Run the application
3. Navigate to the test endpoint (e.g., `/model/1`) or run `php artisan test --filter=test_resource_collection`
4. Observe the error

## Expected Behavior

The `ResourceCollection` should accept a plain array and convert it to array via the `toArray()` method, as it did in Laravel 12.44.

## Actual Behavior

Laravel throws an error when trying to call `resolve()` on an array.

## Code Example

**ResourceCollection:**
```php
class TestResourceCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->resource->toArray();
    }
}
```

**Controller:**
```php
public function index()
{
    $model = TestModel::find(1);

    $resource = [
        'list' => [$model],
        'total' => 1,
    ];

    return new TestResourceCollection($resource);
}
```

## License

MIT
