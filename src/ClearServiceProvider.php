<?php

namespace Mints\Clear;

use Illuminate\Support\ServiceProvider;
use Mints\Clear\Console\Clear;
use Mints\Clear\Console\LogClear;
use Mints\Clear\Console\SessionClear;

class ClearServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SessionClear::class,
                LogClear::class,
                Clear::class,
            ]);
        }
    }

    public function register()
    {
        //
    }
}