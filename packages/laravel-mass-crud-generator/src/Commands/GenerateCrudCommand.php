<?php

namespace Frs\LaravelMassCrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateCrudCommand extends Command
{
    protected $signature = 'make:crud {name} {--m : Generate model} {--mi : Generate migration} {--c : Generate controller} {--s : Generate seeder} {--f : Generate factory} {--r : Generate request}';
    protected $description = 'Generate CRUD operations for a single model';

    public function handle()
    {
        $name = $this->argument('name');
        $this->generateCrudForModel($name);
    }

    protected function generateCrudForModel($name)
    {
        $customStubPath = resource_path('stubs/vendor/crudgenerator');
        $defaultStubPath = __DIR__ . '/../defaults/stubs';

        $noOptions = !$this->option('m') && !$this->option('mi') && !$this->option('c') && !$this->option('s') && !$this->option('f') && !$this->option('r');

        if ($noOptions) {
            $this->generateModel($name, $customStubPath, $defaultStubPath);
            $this->generateMigration($name, $customStubPath, $defaultStubPath);
            $this->generateController($name, $customStubPath, $defaultStubPath);
            $this->generateSeeder($name, $customStubPath, $defaultStubPath);
            $this->generateFactory($name, $customStubPath, $defaultStubPath);
            $this->generateRequest($name, $customStubPath, $defaultStubPath);
            $this->info("{$name} CRUD generated successfully.");
        } else {
            if ($this->option('m')) {
                $this->generateModel($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Model created successfully.");
            }
            if ($this->option('mi')) {
                $this->generateMigration($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Migration created successfully.");
            }
            if ($this->option('c')) {
                $this->generateController($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Controller created successfully.");
            }
            if ($this->option('s')) {
                $this->generateSeeder($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Seeder created successfully.");
            }
            if ($this->option('f')) {
                $this->generateFactory($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Factory created successfully.");
            }
            if ($this->option('r')) {
                $this->generateRequest($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Request created successfully.");
            }
        }
    }

    protected function generateModel($name, $customStubPath, $defaultStubPath)
    {
        $modelPath = app_path("Models/{$name}.php");
        $stub = file_exists("{$customStubPath}/model.stub") ? "{$customStubPath}/model.stub" : "{$defaultStubPath}/model.stub";

        $replacements = [
            '{{modelName}}' => $name,
            // Add other replacements here as needed
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($modelPath, $content);
    }

    protected function generateController($name, $customStubPath, $defaultStubPath)
    {
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");
        $stub = file_exists("{$customStubPath}/controller.stub") ? "{$customStubPath}/controller.stub" : "{$defaultStubPath}/controller.stub";

        $replacements = [
            '{{controllerName}}' => "{$name}Controller",
            '{{modelVariable}}' => Str::lower($name),
            '{{modelVariable}}s' => Str::plural($name),
            '{{modelName}}' => $name,
            // Add other replacements here as needed
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($controllerPath, $content);
    }

    protected function generateMigration($name, $customStubPath, $defaultStubPath)
    {
        $migrationName = 'create_' . Str::plural(Str::snake($name)) . '_table';
        $stub = file_exists("{$customStubPath}/migration.stub") ? "{$customStubPath}/migration.stub" : "{$defaultStubPath}/migration.stub";

        $replacements = [
            '{{modelName}}' => $name,
            '{{tableName}}' => Str::plural(Str::snake($name)),
            // Add other replacements here as needed
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        $migrationPath = database_path('migrations/' . date('Y_m_d_His') . "_{$migrationName}.php");
        file_put_contents($migrationPath, $content);
    }

    protected function generateSeeder($name, $customStubPath, $defaultStubPath)
    {
        $seederPath = database_path("seeders/{$name}Seeder.php");
        $stub = file_exists("{$customStubPath}/seeder.stub") ? "{$customStubPath}/seeder.stub" : "{$defaultStubPath}/seeder.stub";

        $replacements = [
            '{{modelName}}' => $name,
            // Add other replacements here as needed
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($seederPath, $content);
    }

    protected function generateFactory($name, $customStubPath, $defaultStubPath)
    {
        $factoryPath = database_path("factories/{$name}Factory.php");
        $stub = file_exists("{$customStubPath}/factory.stub") ? "{$customStubPath}/factory.stub" : "{$defaultStubPath}/factory.stub";

        $replacements = [
            '{{modelName}}' => $name,
            // Add other replacements here as needed
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($factoryPath, $content);
    }

    protected function generateRequest($name, $customStubPath, $defaultStubPath)
    {
        $requestDirectory = app_path("Http/Requests");
        if (!file_exists($requestDirectory)) {
            mkdir($requestDirectory, 0755, true); // Create the directory recursively
        }

        $requestPath = app_path("Http/Requests/{$name}Request.php");
        $stub = file_exists("{$customStubPath}/request.stub") ? "{$customStubPath}/request.stub" : "{$defaultStubPath}/request.stub";

        $replacements = [
            '{{modelName}}' => $name,
            // Add other replacements here as needed
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($requestPath, $content);
    }
}
