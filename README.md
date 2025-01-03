# Laravel Activity Log

[![Latest Stable Version](https://poser.pugx.org/l0max/laravel-activity-log/v/stable)](https://packagist.org/packages/l0max/laravel-activity-log)
[![Total Downloads](https://poser.pugx.org/l0max/laravel-activity-log/downloads)](https://packagist.org/packages/l0max/laravel-activity-log)
[![License](https://poser.pugx.org/l0max/laravel-activity-log/license)](https://packagist.org/packages/l0max/laravel-activity-log)

A simple package to log user activity in Laravel applications. Admins can view all logs, while users can view only their own logs.

## Installation

You can install the package via Composer:

```bash
composer require l0max/laravel-activity-log
```

To publish the configuration file, run the following command:

```bash
php artisan vendor:publish --provider="L0MAX\ActivityLog\ActivityLogServiceProvider"
```

This will publish the config file `config/activitylog.php`.

## Usage

Once the package is installed, you can use the activity log to track user actions. Each time an action is logged, the `ActivityLog` model stores the user ID and a description of the action.

### Example Usage

```php
use L0MAX\ActivityLog\ActivityLog;

ActivityLog::create([
    'user_id' => auth()->id(),
    'description' => 'User performed some action.',
]);
```

### Viewing Logs

Admins can view all logs, while regular users can view only their own activity logs.

### Policy

A policy is included to handle permissions for viewing logs. Here's a simple example of how to control access to activity logs:

```php
namespace L0MAX\ActivityLog\Policies;

use App\Models\User;
use L0MAX\ActivityLog\ActivityLog;

class ActivityLogPolicy
{
    public function view(User $user, ActivityLog $log)
    {
        return $user->hasRole('admin') || $user->id === $log->user_id;
    }
}
```

### Database Migrations

To create the `activity_logs` table, run the migrations:

```bash
php artisan migrate
```

### Factory

You can generate test data using the factory provided:

```php
ActivityLog::factory()->create();
```

## Testing

You can run the tests with:

```bash
vendor/bin/phpunit
```

Ensure that you have added the proper testing logic in the `tests/Feature/` directory.

## Customization

You can customize the package to suit your needs. The following features can be extended:
- Custom log formats
- Additional policies

## Security

If you discover any security-related issues, please email [ankahdonatus@gmail.com](mailto:ankahdonatus@gmail.com) instead of using the issue tracker.

## Credits

- [L0MAX](https://github.com/L0M4X)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.