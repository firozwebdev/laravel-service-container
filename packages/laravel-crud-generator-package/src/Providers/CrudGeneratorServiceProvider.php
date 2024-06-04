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
        // Stub files publish
        $this->publishes([
            __DIR__.'/../stubs' => resource_path('stubs/vendor/crud-generator'),
        ]);
    }
}
