<?php
namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;
use Frs\LaravelMassCrudGenerator\Core\Helper;

class SeederGenerator{
    public function generate($name, $customStubPath, $defaultStubPath)
    {
        $seederPath = database_path("seeders/{$name}Seeder.php");
        $stub = file_exists("{$customStubPath}/seeder.stub") ? "{$customStubPath}/seeder.stub" : "{$defaultStubPath}/seeder.stub";

        $replacements = [
            '{{modelName}}' => $name,
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($seederPath, $content);
        // Add the seeder to DatabaseSeeder.php
        $this->addSeederToDatabaseSeeder($name . 'Seeder');
    }

    protected function addSeederToDatabaseSeeder($seederClass)
    {
        $databaseSeederPath = database_path('seeders/DatabaseSeeder.php');
        //dd($databaseSeederPath);
        if (file_exists($databaseSeederPath)) {
            $content = file_get_contents($databaseSeederPath);
            
            // Check if the seeder is already included
            if (strpos($content, $seederClass) === false) {
                $newSeederLine = "\t\$this->call({$seederClass}::class);\n";
                
                // Insert the new seeder call before the closing bracket of the run method
                $content = str_replace(
                    "}\n}",
                    $newSeederLine . "\n\t}\n}",
                    $content
                );
                
                file_put_contents($databaseSeederPath, $content);
               
            }
        } 
    }
}