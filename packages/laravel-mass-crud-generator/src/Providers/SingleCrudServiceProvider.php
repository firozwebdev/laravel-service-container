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
    
            // Publish the configuration file with 'crud-config' tag
            $this->publishes([
                __DIR__.'/../../config/crudgenerator.php' => config_path('crudgenerator.php'),
            ], 'crud-config');

            
            $this->publishes([
                __DIR__.'/../../resources/views' => resource_path('views/vendor/crudgenerator'),
            ], 'crud-views');
        }
    
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'crudgenerator');
    }
    
}
