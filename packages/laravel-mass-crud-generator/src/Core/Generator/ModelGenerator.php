<?php
namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;
use Frs\LaravelMassCrudGenerator\Core\Helper;

class ModelGenerator{
    public function generate($name, $customStubPath, $defaultStubPath)
    {
        $modelPath = app_path("Models/{$name}.php");
        $stub = file_exists("{$customStubPath}/model.stub") ? "{$customStubPath}/model.stub" : "{$defaultStubPath}/model.stub";
        $columns = config("crudgenerator.tables.{$name}.columns", []);
        $columnsKey = Helper::getColumskeyForFillableInModel($columns);
        
        $replacements = [
            '{{modelName}}' => $name,
            '{{columnsKey}}' => $columnsKey,
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($modelPath, $content);
    }

}