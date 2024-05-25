<?php

namespace App\Providers;

use App\Services\BooklistService;
use App\Services\Impl\BooklistServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BooklistServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        BooklistService::class => BooklistServiceImpl::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return [BooklistService::class];
    }
}
