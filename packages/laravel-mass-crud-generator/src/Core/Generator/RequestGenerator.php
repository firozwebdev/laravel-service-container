<?php

namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;
use Frs\LaravelMassCrudGenerator\Core\Helper;

class RequestGenerator
{
    // Generate the request file
    public function generate($name, $customStubPath, $defaultStubPath)
    {
        // Define the directory path for requests
        $requestDirectory = app_path("Http/Requests");
        
        // Create the directory if it doesn't exist
        Helper::makeFolder($requestDirectory);

        // Define the path to the request file
        $requestPath = app_path("Http/Requests/{$name}Request.php");
        
        // Determine the stub file path based on custom or default path
        $stub = file_exists("{$customStubPath}/request.stub")
            ? "{$customStubPath}/request.stub"
            : "{$defaultStubPath}/request.stub";

        // Define replacements for stub placeholders
        $replacements = [
            '{{modelName}}' => $name,
        ];

        // Read the content of the stub file
        $content = file_get_contents($stub);
        
        // Replace placeholders with actual values
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        
        // Write the request content to the request file
        file_put_contents($requestPath, $content);
    }
}
