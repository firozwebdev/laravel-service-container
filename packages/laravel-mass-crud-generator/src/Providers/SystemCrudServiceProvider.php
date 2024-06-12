<?php

namespace Frs\LaravelMassCrudGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Frs\LaravelMassCrudGenerator\Commands\GenerateSystemCommand;

class SystemCrudServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/ecommerce.php', 'ecommerce');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateSystemCommand::class,
            ]);

            // Publishing the configuration file
            $this->publishes([
                __DIR__.'/../../config/ecommerce.php' => config_path('system-config.php'),
            ], 'create-ecommerce');

            // Publishing the configuration file
            $this->publishes([
                __DIR__.'/../../config/crm.php' => config_path('system-config.php'),
            ], 'create-crm');
            
            // Publishing the configuration file
            $this->publishes([
                __DIR__.'/../../config/asset-management.php' => config_path('system-config.php'),
            ], 'create-asset-management');
            
            // Publishing the configuration file
            $this->publishes([
                __DIR__.'/../../config/ums.php' => config_path('system-config.php'),
            ], 'create-ums');
    

            $this->publishes([
                __DIR__.'/../../stubs' => resource_path('stubs/vendor/crudgenerator'),
            ], 'crudgenerator-stubs');
        }

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'crudgenerator');
    }
}
