<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
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
        $this->app->bind(\App\Repositories\Interfaces\BookRepository::class, \App\Repositories\Eloquent\BookRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PartRepository::class, \App\Repositories\Eloquent\PartRepositoryEloquent::class);
        //:end-bindings:
    }
}
