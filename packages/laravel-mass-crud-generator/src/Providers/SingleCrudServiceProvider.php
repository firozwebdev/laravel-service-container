<?php

namespace Frs\LaravelMassCrudGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Frs\LaravelMassCrudGenerator\Commands\GenerateCrudCommand;

class SingleCrudServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/crudgenerator.php', 'crudgenerator');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateCrudCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../stubs' => resource_path('stubs/vendor/crudgenerator'),
            ], 'crud-stubs');
        }

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'crudgenerator');
    }
}