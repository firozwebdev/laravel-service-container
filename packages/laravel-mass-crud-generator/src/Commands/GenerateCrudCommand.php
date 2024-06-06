<?php
namespace Frs\LaravelMassCrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateCrudCommand extends Command
{
    protected $signature = 'make:crud {name} {options} {--api : Generate API response in controller}';
    protected $description = 'Generate CRUD operations for a single model';

    public function handle()
    {
        $name = $this->argument('name');
        $isApi = $this->option('api');
        $combinedOptions = $this->argument('options') ?: '';
        $parsedOptions = $this->parseCombinedOptions($combinedOptions);

        $this->generateCrudForModel($name, $parsedOptions, $isApi);
    }

    protected function parseCombinedOptions($combinedOptions)
    {
        // Define the possible options, with multi-character options listed before single-character options
        $options = ['mi', 'm', 'c', 's', 'f', 'r']; 
        $parsedOptions = array_fill_keys($options, false);

        // Create a regex pattern to match any of the options
        $pattern = '/' . implode('|', array_map(function($option) {
            return preg_quote($option, '/');
        }, $options)) . '/';

        // Find all matches in the combined options string
        preg_match_all($pattern, $combinedOptions, $matches);

        // Set the parsed options to true for each match found
        foreach ($matches[0] as $match) {
            $parsedOptions[$match] = true;
        }

        return $parsedOptions;
    }

    protected function generateCrudForModel($name, $parsedOptions, $isApi)
    {
        $customStubPath = resource_path('stubs/vendor/crudgenerator');
        $defaultStubPath = __DIR__ . '/../defaults/stubs';

        $noOptions = !array_filter($parsedOptions);

        if ($noOptions) {
            $this->generateModel($name, $customStubPath, $defaultStubPath);
            $this->generateMigration($name, $customStubPath, $defaultStubPath);
            $this->generateController($name, $customStubPath, $defaultStubPath, $isApi);
            $this->generateSeeder($name, $customStubPath, $defaultStubPath);
            $this->generateFactory($name, $customStubPath, $defaultStubPath);
            $this->generateRequest($name, $customStubPath, $defaultStubPath);
            $this->info("{$name} CRUD generated successfully.");
        } else {
            if ($parsedOptions['mi']) {
                $this->generateMigration($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Migration created successfully.");
            }

            if ($parsedOptions['m']) {
                $this->generateModel($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Model created successfully.");
            }
           
            if ($parsedOptions['c']) {
                $this->generateController($name, $customStubPath, $defaultStubPath, $isApi);
                $this->info("{$name} Controller created successfully.");
            }
           
            if ($parsedOptions['s']) {
                $this->generateSeeder($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Seeder created successfully.");
            }
            if ($parsedOptions['f']) {
                $this->generateFactory($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Factory created successfully.");
            }
            if ($parsedOptions['r']) {
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
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($modelPath, $content);
    }

    protected function generateController($name, $customStubPath, $defaultStubPath, $isApi)
    {
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");
        $stub = $isApi
            ? (file_exists("{$customStubPath}/api_controller.stub") ? "{$customStubPath}/api_controller.stub" : "{$defaultStubPath}/api_controller.stub")
            : (file_exists("{$customStubPath}/controller.stub") ? "{$customStubPath}/controller.stub" : "{$defaultStubPath}/controller.stub");

        $replacements = [
            '{{controllerName}}' => "{$name}Controller",
            '{{modelVariable}}' => Str::camel(Str::singular($name)),
            '{{modelVariables}}' => Str::camel(Str::plural($name)),
            '{{modelName}}' => $name,
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
            '{{modelNamePlural}}' => Str::camel(Str::plural($name)),
            '{{tableName}}' => Str::lower(Str::plural(Str::snake($name))),
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
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($factoryPath, $content);
    }

    protected function generateRequest($name, $customStubPath, $defaultStubPath)
    {
        $requestDirectory = app_path("Http/Requests");
        if (!file_exists($requestDirectory)) {
            mkdir($requestDirectory, 0755, true);
        }

        $requestPath = app_path("Http/Requests/{$name}Request.php");
        $stub = file_exists("{$customStubPath}/request.stub") ? "{$customStubPath}/request.stub" : "{$defaultStubPath}/request.stub";

        $replacements = [
            '{{modelName}}' => $name,
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($requestPath, $content);
    }
}
