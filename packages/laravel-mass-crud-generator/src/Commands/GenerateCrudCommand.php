<?php

namespace Frs\LaravelMassCrudGenerator\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Frs\LaravelMassCrudGenerator\Core\Helper;
use Frs\LaravelMassCrudGenerator\Core\Generator\ModelGenerator;
use Frs\LaravelMassCrudGenerator\Core\Generator\RoutesGenerator;
use Frs\LaravelMassCrudGenerator\Core\Generator\FactoryGenerator;
use Frs\LaravelMassCrudGenerator\Core\Generator\RequestGenerator;
use Frs\LaravelMassCrudGenerator\Core\Generator\MigrationGenerator;
use Frs\LaravelMassCrudGenerator\Core\Generator\ControllerGenerator;
use Frs\LaravelMassCrudGenerator\Core\Generator\SeederGenerator;

class GenerateCrudCommand extends Command
{
    protected $signature = 'make:crud {name} {options?} {--location=} {--api : Generate API response in controller}';
    protected $description = 'Generate CRUD operations for a single model';

    // Dependency injection for generators
    protected $controllerGenerator;
    protected $requestGenerator;
    protected $routesGenerator;
    protected $migrationGenerator;
    protected $modelGenerator;
    protected $seederGenerator;
    protected $factoryGenerator;

    public function __construct()
    {
        parent::__construct();
        // Initialize generator instances
        $this->controllerGenerator = new ControllerGenerator();
        $this->requestGenerator = new RequestGenerator();
        $this->routesGenerator = new RoutesGenerator($this);
        $this->modelGenerator = new ModelGenerator();
        $this->migrationGenerator = new MigrationGenerator();
        $this->seederGenerator = new SeederGenerator();
        $this->factoryGenerator = new FactoryGenerator();
    }

    public function handle()
    {
        // Get command arguments and options
        $name = $this->argument('name');
        $isApi = $this->option('api');
        $combinedOptions = $this->argument('options') ?: '';
        $controllerPath = $this->option('location');
        $parsedOptions = $this->parseCombinedOptions($combinedOptions);

        // Generate CRUD operations based on options
        $this->generateCrudForModel($name, $parsedOptions, $isApi, $controllerPath);
    }

    // Parse combined options string into an array
    protected function parseCombinedOptions($combinedOptions)
    {
        $options = ['mi', 'm', 'c', 's', 'f', 'r'];
        $parsedOptions = array_fill_keys($options, false);

        $pattern = '/' . implode('|', array_map(function ($option) {
            return preg_quote($option, '/');
        }, $options)) . '/';

        preg_match_all($pattern, $combinedOptions, $matches);

        foreach ($matches[0] as $match) {
            $parsedOptions[$match] = true;
        }

        return $parsedOptions;
    }

    // Generate CRUD operations based on model name and options
    protected function generateCrudForModel($name, $parsedOptions, $isApi, $controllerPath)
    {
        $customStubPath = resource_path('stubs/vendor/crudgenerator');
        $defaultStubPath = __DIR__ . '/../defaults/stubs';

        $noOptions = !array_filter($parsedOptions);

        // If no options provided or none selected, generate full CRUD
        if ($noOptions || !$parsedOptions) {
            $this->modelGenerator->generate($name, $customStubPath, $defaultStubPath);
            $this->migrationGenerator->generate($name, $customStubPath, $defaultStubPath);
            $this->controllerGenerator->generate($name, $customStubPath, $defaultStubPath, $isApi, $controllerPath);
            $this->seederGenerator->generate($name, $customStubPath, $defaultStubPath);
            $this->requestGenerator->generate($name, $customStubPath, $defaultStubPath);
            $this->routesGenerator->generate($name, $isApi, $controllerPath);
            $this->factoryGenerator->generate($name, $customStubPath, $defaultStubPath);
            $this->info("{$name} CRUD generated successfully.");
        } else {
            // Generate CRUD operations based on selected options
            foreach ($parsedOptions as $option => $value) {
                if ($value) {
                    switch ($option) {
                        case 'mi':
                            $this->migrationGenerator->generate($name, $customStubPath, $defaultStubPath);
                            $this->info("{$name} Migration created successfully.");
                            break;
                        case 'm':
                            $this->modelGenerator->generate($name, $customStubPath, $defaultStubPath);
                            $this->info("{$name} Model created successfully.");
                            break;
                        case 'c':
                            $this->routesGenerator->generate($name, $isApi, $controllerPath);
                            $this->controllerGenerator->generate($name, $customStubPath, $defaultStubPath, $isApi, $controllerPath);
                            $this->info("{$name} Controller created successfully.");
                            break;
                        case 's':
                            $this->seederGenerator->generate($name, $customStubPath, $defaultStubPath);
                            $this->info("{$name} Seeder created successfully.");
                            break;
                        case 'f':
                            $this->factoryGenerator->generate($name, $customStubPath, $defaultStubPath);
                            $this->info("{$name} Factory created successfully.");
                            break;
                        case 'r':
                            $this->requestGenerator->generate($name, $customStubPath, $defaultStubPath);
                            $this->info("{$name} Request created successfully.");
                            break;
                        default:
                            break;
                    }
                }
            }
        }
    }
}
