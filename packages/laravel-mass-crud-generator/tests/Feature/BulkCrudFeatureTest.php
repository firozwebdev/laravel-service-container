<?php

namespace Frs\LaravelMassCrudGenerator\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class BulkCrudFeatureTest extends TestCase
{
    /** @test */
    public function it_generates_all_crud_files_for_multiple_models()
    {
        $modelNames = ['User', 'Order', 'Product'];
        Artisan::call('make:bulkcrud', ['names' => $modelNames]);

        foreach ($modelNames as $name) {
            $this->assertTrue(File::exists(app_path("Models/{$name}.php")));
            $this->assertTrue(File::exists(app_path("Http/Controllers/{$name}Controller.php")));
            $this->assertTrue(File::exists(database_path("migrations/*_create_" . \Str::plural(\Str::snake($name)) . "_table.php")));
            $this->assertTrue(File::exists(database_path("seeders/{$name}Seeder.php")));
            $this->assertTrue(File::exists(database_path("factories/{$name}Factory.php")));

            // Clean up generated files
            File::delete(app_path("Models/{$name}.php"));
            File::delete(app_path("Http/Controllers/{$name}Controller.php"));
            File::delete(database_path("migrations/*_create_" . \Str::plural(\Str::snake($name)) . "_table.php")));
            File::delete(database_path("seeders/{$name}Seeder.php"));
            File::delete(database_path("factories/{$name}Factory.php"));
        }
    }
}
