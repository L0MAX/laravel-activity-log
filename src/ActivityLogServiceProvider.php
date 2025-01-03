<?php

namespace L0MAX\ActivityLog;

use Illuminate\Support\ServiceProvider;
use L0MAX\ActivityLog\Policies\ActivityLogPolicy;

class ActivityLogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/activitylog.php', 'activitylog');
    }

    public function boot()
    {
        $this->registerPolicies([
            ActivityLog::class => ActivityLogPolicy::class,
        ]);

        if ($this->app->runningInConsole()) {
            // Publish the migration
            $this->publishes([
                __DIR__ . '/Migrations/create_activity_logs_table.php' => database_path('migrations/' . date('Y_m_d_His') . '_create_activity_logs_table.php'),
            ], 'migrations');

            // Publish config
            $this->publishes([
                __DIR__ . '/../config/activitylog.php' => config_path('activitylog.php'),
            ], 'config');
        }

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
    }
}
