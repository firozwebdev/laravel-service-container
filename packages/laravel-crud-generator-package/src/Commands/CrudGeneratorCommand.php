<?php

namespace Frs\LaravelCrudGenerator\Commands;

use Illuminate\Console\Command;

class CrudGeneratorCommand extends Command
{
    protected $signature = 'make:crud {name}';
    protected $description = 'Generate CRUD operations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $this->generateModel($name);
        $this->generateController($name);
        $this->generateMigration($name);

        $this->info('CRUD for ' . $name . ' generated successfully!');
    }

    protected function getStub($type)
    {
        $path = resource_path("stubs/vendor/crud-generator/{$type}.stub");
        if (!file_exists($path)) {
            $path = __DIR__ . "/../stubs/{$type}.stub";
        }
        return file_get_contents($path);
    }

    protected function generateModel($name)
    {
        $namespace = config('crud-generator.namespace', 'App');
        $stub = $this->getStub('model');
        $stub = str_replace(['{{modelName}}', '{{namespace}}'], [$name, $namespace], $stub);
        file_put_contents(app_path("/Models/{$name}.php"), $stub);
    }

    protected function generateController($name)
    {
        $namespace = config('crud-generator.namespace', 'App');
        $stub = $this->getStub('controller');
        $stub = str_replace(['{{controllerName}}', '{{namespace}}'], [$name . 'Controller', $namespace], $stub);
        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $stub);
    }

    protected function generateMigration($name)
    {
        $tableName = strtolower(\Str::plural($name));
        $stub = $this->getStub('migration');
        $stub = str_replace('{{tableName}}', $tableName, $stub);
        $timestamp = date('Y_m_d_His');
        file_put_contents(database_path("/migrations/{$timestamp}_create_{$tableName}_table.php"), $stub);
    }
}
