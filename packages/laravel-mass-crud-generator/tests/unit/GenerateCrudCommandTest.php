<?php

namespace Frs\LaravelMassCrudGenerator\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Tests\TestCase;

class GenerateCrudCommandTest extends TestCase
{
    /** @test */
    public function it_creates_crud_for_a_single_model()
    {
        // Define the model name
        $modelName = 'Post';

        // Run the make:crud command
        Artisan::call('make:crud', ['name' => $modelName]);

        // Assert CRUD files were created
        $this->assertTrue(File::exists(app_path("/Models/{$modelName}.php")));
        $this->assertTrue(File::exists(app_path("/Http/Controllers/{$modelName}Controller.php")));
        $this->assertTrue(File::exists(database_path("/migrations/*_create_" . Str::plural(Str::snake($modelName)) . "_table.php")));
        $this->assertTrue(File::exists(database_path("/seeders/{$modelName}Seeder.php")));
        $this->assertTrue(File::exists(database_path("/factories/{$modelName}Factory.php")));

        // Clean up generated files
        File::delete(app_path("/Models/{$modelName}.php"));
        File::delete(app_path("/Http/Controllers/{$modelName}Controller.php"));
        File::delete(database_path("/migrations/*_create_" . Str::plural(Str::snake($modelName)) . "_table.php"));
        File::delete(database_path("/seeders/{$modelName}Seeder.php"));
        File::delete(database_path("/factories/{$modelName}Factory.php"));
    }
}
