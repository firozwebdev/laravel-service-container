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

    protected function generateModel($name)
    {
        $stub = file_get_contents(__DIR__.'/../stubs/model.stub');
        $stub = str_replace('{{modelName}}', $name, $stub);
        file_put_contents(app_path("/Models/{$name}.php"), $stub);
    }

    protected function generateController($name)
    {
        $stub = file_get_contents(__DIR__.'/../stubs/controller.stub');
        $stub = str_replace('{{controllerName}}', $name.'Controller', $stub);
        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $stub);
    }

    protected function generateMigration($name)
    {
        $tableName = strtolower(\Str::plural($name));
        $stub = file_get_contents(__DIR__.'/../stubs/migration.stub');
        $stub = str_replace('{{tableName}}', $tableName, $stub);
        $timestamp = date('Y_m_d_His');
        file_put_contents(database_path("/migrations/{$timestamp}_create_{$tableName}_table.php"), $stub);
    }
}
