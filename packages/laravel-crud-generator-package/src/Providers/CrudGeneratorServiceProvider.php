<?php

namespace Frs\LaravelCrudGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Frs\LaravelCrudGenerator\Commands\CrudGeneratorCommand;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            CrudGeneratorCommand::class,
        ]);
    }

    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/../config/crud-generator.php' => config_path('crud-generator.php'),
        ], 'config');

        // Publish stub files
        $this->publishes([
            __DIR__ . '/../stubs' => resource_path('stubs/vendor/crud-generator'),
        ], 'crud-stubs');
    }
}
