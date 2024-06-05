<?php

namespace Frs\LaravelMassCrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class GenerateCrudCommand extends Command
{
    protected $signature = 'make:crud {name} {--m : Generate model} {--mi : Generate migration} {--c : Generate controller} {--s : Generate seeder} {--f : Generate factory} {--r : Generate request}';

    protected $description = 'Generate CRUD operations for a single model';

    public function handle()
    {
        $name = $this->argument('name');
        $this->generateCrudForModel($name);
        $this->info("CRUD for the model {$name} generated successfully.");
    }

    protected function generateCrudForModel($name)
    {
        // Paths to custom stubs
        $stubPath = resource_path('stubs/vendor/crudgenerator');

        // Check if any options are specified
        $options = $this->options();

        if (!$this->option('m') && !$this->option('c') && !$this->option('s') && !$this->option('f') && !$this->option('r')) {
            // Generate all components if no options are specified
            $this->generateModel($name, $stubPath);
            $this->generateMigration($name, $stubPath);
            $this->generateController($name, $stubPath);
            $this->generateSeeder($name, $stubPath);
            $this->generateFactory($name, $stubPath);
            $this->generateRequest($name, $stubPath);
        }else{
            // Generate only the specified components
            if ($this->option('m')) {
                $this->generateModel($name, $stubPath);
            }
            if ($this->option('mi')) {
                $this->generateMigration($name, $stubPath);
            }
            if ($this->option('c')) {
                $this->generateController($name, $stubPath);
            }
            if ($this->option('s')) {
                $this->generateSeeder($name, $stubPath);
            }
            if ($this->option('f')) {
                $this->generateFactory($name, $stubPath);
            }
            if ($this->option('r')) {
                $this->generateRequest($name, $stubPath);
            }
        }
       
        
    }

    protected function generateModel($name, $stubPath)
    {
        $modelPath = app_path("Models/{$name}.php");
        $stub = file_get_contents("{$stubPath}/model.stub");
        $stub = str_replace('DummyClass', $name, $stub);
        file_put_contents($modelPath, $stub);
    }

    protected function generateController($name, $stubPath)
    {
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");
        $stub = file_get_contents("{$stubPath}/controller.stub");
        $stub = str_replace(['DummyClass', 'dummyclass'], [$name, Str::snake($name)], $stub);
        file_put_contents($controllerPath, $stub);
    }

    protected function generateMigration($name, $stubPath)
    {
        $migrationName = 'create_' . Str::plural(Str::snake($name)) . '_table';
        $stub = file_get_contents("{$stubPath}/migration.stub");
        $stub = str_replace('DummyClass', $name, $stub);

        $migrationPath = database_path('migrations/' . date('Y_m_d_His') . "_{$migrationName}.php");
        file_put_contents($migrationPath, $stub);
    }

    protected function generateSeeder($name, $stubPath)
    {
        $seederPath = database_path("seeders/{$name}Seeder.php");
        $stub = file_get_contents("{$stubPath}/seeder.stub");
        $stub = str_replace('DummyClass', $name, $stub);
        file_put_contents($seederPath, $stub);
    }

    protected function generateFactory($name, $stubPath)
    {
        $factoryPath = database_path("factories/{$name}Factory.php");
        $stub = file_get_contents("{$stubPath}/factory.stub");
        $stub = str_replace('DummyClass', $name, $stub);
        file_put_contents($factoryPath, $stub);
    }

    protected function generateRequest($name, $stubPath)
    {
        $requestDirectory = app_path("Http/Requests");
        if (!file_exists($requestDirectory)) {
            mkdir($requestDirectory, 0755, true); // Create the directory recursively
        }

        $requestPath = app_path("Http/Requests/{$name}Request.php");
        $stub = file_get_contents("{$stubPath}/request.stub");
        $stub = str_replace('DummyClass', $name, $stub);
        file_put_contents($requestPath, $stub);
    }

}
