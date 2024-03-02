<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            \App\Bussiness\Domain\Repositories\IRegisterKey::class,
            \App\Repositories\Eloquent\RegisterKey::class
        );
        $this->app->bind(
            \App\Bussiness\Domain\Repositories\IGetPixKeyByCheckingAccountIdAndType::class,
            \App\Repositories\Eloquent\GetPixKeyByCheckingAccountIdAndType::class
        );
        $this->app->bind(
            \App\Bussiness\Domain\Repositories\IGetCheckingAccountByNumber::class,
            \App\Repositories\Eloquent\GetCheckingAccountByNumber::class
        );
    }
}
