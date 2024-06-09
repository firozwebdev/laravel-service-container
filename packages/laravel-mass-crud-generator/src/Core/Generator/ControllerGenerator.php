<?php
namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Frs\LaravelMassCrudGenerator\Core\Helper;
use Illuminate\Support\Str;


class ControllerGenerator
{
    public  function generate($name, $customStubPath, $defaultStubPath, $isApi, $controllerPath)
    {
        $controllerNamespace = 'App\\Http\\Controllers';
        if ($controllerPath) {
            $controllerNamespace .= '\\' . str_replace('/', '\\', trim($controllerPath, '/'));
            $controllerPath = 'Http/Controllers/' . trim($controllerPath, '/');
            $onlyControllerNamespace = 'use App\Http\Controllers\Controller;';
        } else {
            $controllerPath = 'Http/Controllers';
            $onlyControllerNamespace = '';
        }

        $controllerDirectory = app_path($controllerPath);
        Helper::makeFolder($controllerDirectory);

        $controllerFilePath = app_path("{$controllerPath}/{$name}Controller.php");
        $stub = $isApi
            ? (file_exists("{$customStubPath}/api_controller.stub") ? "{$customStubPath}/api_controller.stub" : "{$defaultStubPath}/api_controller.stub")
            : (file_exists("{$customStubPath}/controller.stub") ? "{$customStubPath}/controller.stub" : "{$defaultStubPath}/controller.stub");

        $replacements = [
            '{{controllerNamespace}}' => $controllerNamespace,
            '{{onlyControllerNamespace}}' => $onlyControllerNamespace,
            '{{controllerName}}' => "{$name}Controller",
            '{{modelVariable}}' => Str::camel(Str::singular($name)),
            '{{modelVariables}}' => Str::camel(Str::plural($name)),
            '{{modelName}}' => $name,
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($controllerFilePath, $content);
    }

}