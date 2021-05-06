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
        $this->app->bind(
            'App\IRepository\IUserRepository',
            'App\Repository\UserRepository'
        );
        $this->app->bind(
            'App\IRepository\ITestRepository',
            'App\Repository\TestRepository'
        );
        $this->app->bind(
            'App\IRepository\IAmountAssignedRepository',
            'App\Repository\AmountAssignedRepository'
        );
        $this->app->bind(
            'App\IRepository\IVoucherRepository',
            'App\Repository\VoucherRepository'
        );
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
