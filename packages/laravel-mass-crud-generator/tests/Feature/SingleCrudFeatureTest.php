<?php

namespace Frs\LaravelMassCrudGenerator\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class SingleCrudFeatureTest extends TestCase
{
    /** @test */
    public function it_generates_all_crud_files_for_a_single_model()
    {
        $modelName = 'Product';
        Artisan::call('make:crud', ['name' => $modelName]);

        $this->assertTrue(File::exists(app_path("Models/{$modelName}.php")));
        $this->assertTrue(File::exists(app_path("Http/Controllers/{$modelName}Controller.php")));
        $this->assertTrue(File::exists(database_path("migrations/*_create_" . \Str::plural(\Str::snake($modelName)) . "_table.php")));
        $this->assertTrue(File::exists(database_path("seeders/{$modelName}Seeder.php")));
        $this->assertTrue(File::exists(database_path("factories/{$modelName}Factory.php")));

        // Clean up generated files
        File::delete(app_path("Models/{$modelName}.php"));
        File::delete(app_path("Http/Controllers/{$modelName}Controller.php"));
        File::delete(database_path("migrations/*_create_" . \Str::plural(\Str::snake($modelName)) . "_table.php"));
        File::delete(database_path("seeders/{$modelName}Seeder.php"));
        File::delete(database_path("factories/{$modelName}Factory.php"));
    }
}
