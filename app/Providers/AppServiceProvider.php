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
            'App\IRepositories\ITestRepository',
            'App\Repositories\TestRepository'
        );
        $this->app->bind(
            'App\IRepositories\IAmountAssignedRepository',
            'App\Repositories\AmountAssignedRepository'
        );
        $this->app->bind(
            'App\IRepositories\IUserRepository',
            'App\Repositories\UserRepository'
        );
        $this->app->bind(
            'App\IRepositories\IVoucherRepository',
            'App\Repositories\VoucherRepository'
        );
        $this->app->bind(
            'App\IRepositories\ICashRegisterRepository',
            'App\Repositories\CashRegisterRepository'
        );
        $this->app->bind(
            'App\IRepositories\IBoxRepository',
            'App\Repositories\BoxRepository'
        );
        $this->app->bind(
            'App\IRepositories\IUserTypeRepository',
            'App\Repositories\UserTypeRepository'
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('America/Mexico_City');
    }
}
