<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Interfaces\WorkingDayOfWeekRepositoryInterface::class, \App\Infrastructure\Repositories\WorkingDayOfWeekRepository::class);
        $this->app->bind(\App\Interfaces\AttendanceRepositoryInterface::class, \App\Infrastructure\Repositories\AttendanceRepository::class);
        $this->app->bind(\App\Interfaces\RequestRepositoryInterface::class, \App\Infrastructure\Repositories\RequestRepository::class);
        $this->app->bind(\App\Interfaces\HolidayRepositoryInterface::class, \App\Infrastructure\Repositories\HolidayRepository::class);
        $this->app->bind(\App\Interfaces\EloquentUserRepositoryInterface::class, \App\Infrastructure\Repositories\EloquentUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
