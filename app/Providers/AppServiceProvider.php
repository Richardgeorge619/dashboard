<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AddressValidator;
use App\Services\GoogleAddressValidator;
use App\Services\UserValidator;
use App\Services\UserValidatorInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AddressValidator::class, GoogleAddressValidator::class);
        $this->app->bind(UserValidatorInterface::class, UserValidator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
