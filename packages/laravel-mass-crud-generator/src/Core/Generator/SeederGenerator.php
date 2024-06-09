<?php

namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;
use Frs\LaravelMassCrudGenerator\Core\Helper;

class SeederGenerator
{
    // Generate the seeder file
    public function generate($name, $customStubPath, $defaultStubPath)
    {
        // Define the path to the seeder file
        $seederPath = database_path("seeders/{$name}Seeder.php");
        
        // Determine the stub file path based on custom or default path
        $stub = file_exists("{$customStubPath}/seeder.stub")
            ? "{$customStubPath}/seeder.stub"
            : "{$defaultStubPath}/seeder.stub";

        // Define replacements for stub placeholders
        $replacements = [
            '{{modelName}}' => $name,
        ];

        // Read the content of the stub file
        $content = file_get_contents($stub);
        
        // Replace placeholders with actual values
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        
        // Write the seeder content to the seeder file
        file_put_contents($seederPath, $content);
        
        // Add the seeder to DatabaseSeeder.php
        $this->addSeederToDatabaseSeeder($name . 'Seeder');
    }

    // Add the seeder to DatabaseSeeder.php
    protected function addSeederToDatabaseSeeder($seederClass)
    {
        // Define the path to DatabaseSeeder.php
        $databaseSeederPath = database_path('seeders/DatabaseSeeder.php');
        
        // Check if DatabaseSeeder.php exists
        if (file_exists($databaseSeederPath)) {
            // Read the content of DatabaseSeeder.php
            $content = file_get_contents($databaseSeederPath);
            
            // Check if the seeder is already included
            if (strpos($content, $seederClass) === false) {
                // Define the line to add the seeder call
                $newSeederLine = "\t\$this->call({$seederClass}::class);\n";
                
                // Insert the new seeder call before the closing bracket of the run method
                $content = str_replace(
                    "}\n}",
                    $newSeederLine . "\n\t}\n}",
                    $content
                );
                
                // Write the updated content back to DatabaseSeeder.php
                file_put_contents($databaseSeederPath, $content);
            }
        }
    }
}
