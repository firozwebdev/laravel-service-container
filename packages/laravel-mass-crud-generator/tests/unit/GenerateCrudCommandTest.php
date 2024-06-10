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
        $this->assertCrudFilesExist($modelName);

        // Clean up generated files
        $this->cleanupCrudFiles($modelName);
    }

    /** @test */
    public function it_creates_crud_with_options()
    {
        // Define the model name
        $modelName = 'Post';
        $options = 'mc';

        // Run the make:crud command with options
        Artisan::call('make:crud', ['name' => $modelName, '--options' => $options]);

        // Assert specific CRUD files were created based on options
        $this->assertTrue(File::exists(app_path("/Models/{$modelName}.php")));
        $this->assertTrue(File::exists(app_path("/Http/Controllers/{$modelName}Controller.php")));
        // Other files should not be created
        $this->assertFalse(File::exists(database_path("/seeders/{$modelName}Seeder.php")));
        $this->assertFalse(File::exists(database_path("/factories/{$modelName}Factory.php")));

        // Clean up generated files
        $this->cleanupCrudFiles($modelName, $options);
    }

    /** @test */
    public function it_creates_crud_for_multiple_models()
    {
        // Define the model names
        $modelNames = ['Category', 'Product'];

        // Run the make:bulkcrud command
        Artisan::call('make:bulkcrud', ['names' => $modelNames]);

        // Assert CRUD files were created for each model
        foreach ($modelNames as $modelName) {
            $this->assertCrudFilesExist($modelName);
        }

        // Clean up generated files
        foreach ($modelNames as $modelName) {
            $this->cleanupCrudFiles($modelName);
        }
    }

    /** @test */
    public function it_creates_api_crud_for_a_single_model()
    {
        // Define the model name
        $modelName = 'Post';

        // Run the make:crud command with --api option
        Artisan::call('make:crud', ['name' => $modelName, '--api' => true]);

        // Assert CRUD files were created, including API specific controller
        $this->assertCrudFilesExist($modelName, true);

        // Clean up generated files
        $this->cleanupCrudFiles($modelName);
    }

    /** @test */
    public function it_creates_crud_in_custom_location()
    {
        // Define the model name and custom location
        $modelName = 'Post';
        $location = 'Custom';

        // Run the make:crud command with custom location
        Artisan::call('make:crud', ['name' => $modelName, '--location' => $location]);

        // Assert CRUD files were created in the custom location
        $this->assertTrue(File::exists(app_path("/{$location}/Models/{$modelName}.php")));
        $this->assertTrue(File::exists(app_path("/{$location}/Http/Controllers/{$modelName}Controller.php")));

        // Clean up generated files
        $this->cleanupCrudFiles($modelName, '', $location);
    }

    protected function assertCrudFilesExist($modelName, $isApi = false)
    {
        $this->assertTrue(File::exists(app_path("/Models/{$modelName}.php")));
        $this->assertTrue(File::exists(app_path("/Http/Controllers/{$modelName}Controller" . ($isApi ? 'Api' : '') . ".php")));
        $this->assertTrue(File::exists(database_path("/migrations/*_create_" . Str::plural(Str::snake($modelName)) . "_table.php")));
        $this->assertTrue(File::exists(database_path("/seeders/{$modelName}Seeder.php")));
        $this->assertTrue(File::exists(database_path("/factories/{$modelName}Factory.php")));
    }

    protected function cleanupCrudFiles($modelName, $options = '', $location = '')
    {
        $pathPrefix = $location ? "/{$location}" : '';
        File::delete(app_path("{$pathPrefix}/Models/{$modelName}.php"));
        File::delete(app_path("{$pathPrefix}/Http/Controllers/{$modelName}Controller.php"));
        $migrations = File::glob(database_path("/migrations/*_create_" . Str::plural(Str::snake($modelName)) . "_table.php"));
        foreach ($migrations as $migration) {
            File::delete($migration);
        }
        if (strpos($options, 's') !== false) {
            File::delete(database_path("/seeders/{$modelName}Seeder.php"));
        }
        if (strpos($options, 'f') !== false) {
            File::delete(database_path("/factories/{$modelName}Factory.php"));
        }
    }
}
