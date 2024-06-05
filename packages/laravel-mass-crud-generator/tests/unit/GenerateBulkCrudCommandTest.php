<?php

namespace Frs\LaravelMassCrudGenerator\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class GenerateBulkCrudCommandTest extends TestCase
{
    /** @test */
    public function it_creates_crud_for_multiple_models()
    {
        // Define an array of model names
        $modelNames = ['Post', 'Blog', 'Category'];

        // Run the make:bulkcrud command
        Artisan::call('make:bulkcrud', ['names' => $modelNames]);

        // Assert CRUD files were created for each model
        foreach ($modelNames as $name) {
            $this->assertTrue(File::exists(app_path("/Models/{$name}.php")));
            $this->assertTrue(File::exists(app_path("/Http/Controllers/{$name}Controller.php")));
            $this->assertTrue(File::exists(database_path("/migrations/*_create_" . \Str::plural(\Str::snake($name)) . "_table.php")));
            $this->assertTrue(File::exists(database_path("/seeders/{$name}Seeder.php")));
            $this->assertTrue(File::exists(database_path("/factories/{$name}Factory.php")));
        }

        // Clean up generated files
        foreach ($modelNames as $name) {
            File::delete(app_path("/Models/{$name}.php"));
            File::delete(app_path("/Http/Controllers/{$name}Controller.php"));
            File::delete(database_path("/migrations/*_create_" . \Str::plural(\Str::snake($name)) . "_table.php"));
            File::delete(database_path("/seeders/{$name}Seeder.php"));
            File::delete(database_path("/factories/{$name}Factory.php"));
        }
    }
}
