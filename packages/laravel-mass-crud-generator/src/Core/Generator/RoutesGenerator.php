<?php
namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;
use Frs\LaravelMassCrudGenerator\Core\Helper;


class RoutesGenerator{
    public function generate($name, $isApi, $controllerPath)
    {
        $routesPath = base_path('routes/web.php');
        if ($isApi) {
            $routesPath = base_path('routes/api.php');
        }

        $routeName = Str::kebab(Str::plural($name));
        $controllerName = "{$name}Controller";
        
        // Default namespace
        $controllerNamespace = 'App\\Http\\Controllers';
        if ($controllerPath) {
            $controllerNamespace .= '\\' . str_replace('/', '\\', trim($controllerPath, '/'));
        }

        $useStatement = "use {$controllerNamespace}\\{$controllerName};";
        
        $routeDefinition = $isApi 
            ? "Route::apiResource('{$routeName}', {$controllerName}::class);" 
            : "Route::resource('{$routeName}', {$controllerName}::class);";

        // Read the content of the routes file
       
        Helper::putStatementAfterSpecificLine($routesPath,'use',$useStatement);
        Helper::putStatementAfterSpecificLine($routesPath,'Route',$routeDefinition);

       
    }
}