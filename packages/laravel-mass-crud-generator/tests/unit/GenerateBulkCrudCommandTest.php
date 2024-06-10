<?php
namespace Frs\LaravelMassCrudGenerator\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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
            $this->assertCrudFilesExist($name);
        }

        // Clean up generated files
        foreach ($modelNames as $name) {
            $this->cleanupCrudFiles($name);
        }
    }

    protected function assertCrudFilesExist($modelName)
    {
        $this->assertTrue(File::exists(app_path("/Models/{$modelName}.php")));
        $this->assertTrue(File::exists(app_path("/Http/Controllers/{$modelName}Controller.php")));
        $migrationFiles = File::glob(database_path("/migrations/*_create_" . Str::plural(Str::snake($modelName)) . "_table.php"));
        $this->assertNotEmpty($migrationFiles);
        $this->assertTrue(File::exists(database_path("/seeders/{$modelName}Seeder.php")));
        $this->assertTrue(File::exists(database_path("/factories/{$modelName}Factory.php")));
    }

    protected function cleanupCrudFiles($modelName)
    {
        File::delete(app_path("/Models/{$modelName}.php"));
        File::delete(app_path("/Http/Controllers/{$modelName}Controller.php"));
        $migrationFiles = File::glob(database_path("/migrations/*_create_" . Str::plural(Str::snake($modelName)) . "_table.php"));
        foreach ($migrationFiles as $migration) {
            File::delete($migration);
        }
        File::delete(database_path("/seeders/{$modelName}Seeder.php"));
        File::delete(database_path("/factories/{$modelName}Factory.php"));
    }
}
