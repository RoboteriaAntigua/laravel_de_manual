<?php

namespace App\Providers;

use App\myClases\Baz;
use App\myClases\Foo;
use Illuminate\Support\ServiceProvider;

class primerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(Foo::class, function($app){
            return new Foo( new Baz("pepe"));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
