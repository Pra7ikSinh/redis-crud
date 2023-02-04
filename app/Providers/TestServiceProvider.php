<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades2\TestFClass;

class TestServiceProvider extends ServiceProvider
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
        $this->app->bind('testfclass',function(){
            return new TestFClass();
        });    }
}
