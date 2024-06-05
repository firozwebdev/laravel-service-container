<?php

namespace Frs\LaravelMassCrudGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Frs\LaravelMassCrudGenerator\Commands\GenerateBulkCrudCommand;

class BulkCrudServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/crudgenerator.php', 'crudgenerator');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateBulkCrudCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../../config/crudgenerator.php' => config_path('crudgenerator.php'),
                __DIR__.'/../../stubs' => resource_path('stubs/vendor/crudgenerator'),
            ], 'crudgenerator-stubs');
        }

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'crudgenerator');
    }
}
