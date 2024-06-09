<?php

namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Frs\LaravelMassCrudGenerator\Core\Helper;
use Illuminate\Support\Str;

class ControllerGenerator
{
    /**
     * Generate a controller file for the given resource.
     *
     * @param string $name
     * @param string $customStubPath
     * @param string $defaultStubPath
     * @param bool $isApi
     * @param string|null $controllerPath
     * @return void
     */
    public function generate($name, $customStubPath, $defaultStubPath, $isApi, $controllerPath)
    {
        // Determine controller namespace
        $controllerNamespace = 'App\\Http\\Controllers';
        if ($controllerPath) {
            $controllerNamespace .= '\\' . str_replace('/', '\\', trim($controllerPath, '/'));
            $controllerPath = 'Http/Controllers/' . trim($controllerPath, '/');
            $onlyControllerNamespace = 'use App\Http\Controllers\Controller;';
        } else {
            $controllerPath = 'Http/Controllers';
            $onlyControllerNamespace = '';
        }

        // Create the controller directory if it doesn't exist
        $controllerDirectory = app_path($controllerPath);
        Helper::makeFolder($controllerDirectory);

        // Determine the path and stub file to use based on API or web controllers
        $controllerFilePath = app_path("{$controllerPath}/{$name}Controller.php");
        $stub = $isApi
            ? (file_exists("{$customStubPath}/api_controller.stub") ? "{$customStubPath}/api_controller.stub" : "{$defaultStubPath}/api_controller.stub")
            : (file_exists("{$customStubPath}/controller.stub") ? "{$customStubPath}/controller.stub" : "{$defaultStubPath}/controller.stub");

        // Define replacements for stub file placeholders
        $replacements = [
            '{{controllerNamespace}}' => $controllerNamespace,
            '{{onlyControllerNamespace}}' => $onlyControllerNamespace,
            '{{controllerName}}' => "{$name}Controller",
            '{{modelVariable}}' => Str::camel(Str::singular($name)),
            '{{modelVariables}}' => Str::camel(Str::plural($name)),
            '{{modelName}}' => $name,
        ];

        // Generate the controller file content from the stub file
        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);

        // Write the content to the controller file
        file_put_contents($controllerFilePath, $content);
    }
}
