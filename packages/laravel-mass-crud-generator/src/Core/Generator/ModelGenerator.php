<?php

namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;
use Frs\LaravelMassCrudGenerator\Core\Helper;

class ModelGenerator
{
    // Generate the model file
    public function generate($name, $customStubPath, $defaultStubPath)
    {
        // Define the path to the model file
        $modelPath = app_path("Models/{$name}.php");
        
        // Determine the stub file path based on custom or default path
        $stub = file_exists("{$customStubPath}/model.stub")
            ? "{$customStubPath}/model.stub"
            : "{$defaultStubPath}/model.stub";

        // Read columns from the configuration file
        $columns = config("crudgenerator.tables.{$name}.columns", []);
        
        // Get the fillable columns key for the model
        $columnsKey = Helper::getColumskeyForFillableInModel($columns);

        // Define replacements for stub placeholders
        $replacements = [
            '{{modelName}}' => $name,
            '{{columnsKey}}' => $columnsKey,
        ];

        // Read the content of the stub file
        $content = file_get_contents($stub);
        
        // Replace placeholders with actual values
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        
        // Write the model content to the model file
        file_put_contents($modelPath, $content);
    }
}
