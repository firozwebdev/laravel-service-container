<?php

namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Frs\LaravelMassCrudGenerator\Core\Helper;

class RoutesGenerator
{
    protected $command;

    /**
     * Create a new instance.
     *
     * @param Command|null $command
     */
    public function __construct(Command $command = null)
    {
        $this->command = $command;
    }

    /**
     * Generate routes for the given resource.
     *
     * @param string $name
     * @param bool $isApi
     * @param string|null $controllerPath
     * @return void
     */
    public function generate($name, $isApi, $controllerPath)
    {
        // Determine the routes file path
        $routesPath = $isApi ? base_path('routes/api.php') : base_path('routes/web.php');
        
        // Generate route name and controller name
        $routeName = Str::kebab(Str::plural($name));
        $controllerName = "{$name}Controller";
        
        // Default controller namespace
        $controllerNamespace = 'App\\Http\\Controllers';

        // Append custom controller path if provided
        if ($controllerPath) {
            $controllerNamespace .= '\\' . str_replace('/', '\\', trim($controllerPath, '/'));
        }

        // Generate the 'use' statement for the controller
        $useStatement = "use {$controllerNamespace}\\{$controllerName};";
        
        // Generate route definition based on API or web routes
        $routeDefinition = $isApi 
            ? "Route::apiResource('{$routeName}', {$controllerName}::class);" 
            : "Route::resource('{$routeName}', {$controllerName}::class);";

        // Generate route if it doesn't already exist
        $this->generateRouteIfNotExists($routesPath, $routeDefinition, $useStatement, $routeName);
    }

    /**
     * Generate route if it doesn't already exist in the routes file.
     *
     * @param string $routesPath
     * @param string $routeDefinition
     * @param string $useStatement
     * @param string $routeName
     * @return void
     */
    protected function generateRouteIfNotExists($routesPath, $routeDefinition, $useStatement, $routeName)
    {
        // Check if the routes file exists
        if (!File::exists($routesPath)) {
            $this->command->error("Routes file not found at '{$routesPath}'.");
            return;
        }

        // Read the content of the routes file
        $routesContent = File::get($routesPath);

        // Check if the route already exists in the routes file
        if (strpos($routesContent, $routeDefinition) !== false) {
            $this->command->info("Route '{$routeName}' already exists and was skipped.");
            return;
        }

        // Insert 'use' statement and route definition after specific line
        Helper::putStatementAfterSpecificLine($routesPath, 'use', $useStatement);
        Helper::putStatementAfterSpecificLine($routesPath, 'Route', $routeDefinition);

        // Provide success message
        $this->command->info("Route '{$routeName}' generated successfully.");
    }
}
