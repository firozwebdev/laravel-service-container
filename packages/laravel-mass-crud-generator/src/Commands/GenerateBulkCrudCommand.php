<?php

namespace Frs\LaravelMassCrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class GenerateBulkCrudCommand extends Command
{
    protected $signature = 'make:bulkcrud {names*}';
    protected $description = 'Generate CRUD operations for multiple models';

    public function handle()
    {
        $names = $this->argument('names');
        foreach ($names as $name) {
            $this->generateCrudForModel($name);
        }
        $this->info("CRUD for the provided models generated successfully.");
    }

    protected function generateCrudForModel($name)
    {
        Artisan::call('make:model', ['name' => 'Models/' . $name]);
        Artisan::call('make:controller', ['name' => 'Http/Controllers/' . $name . 'Controller', '--model' => 'Models/' . $name]);
        Artisan::call('make:migration', ['name' => 'create_' . Str::plural(Str::snake($name)) . '_table', '--create' => Str::plural(Str::snake($name))]);
        Artisan::call('make:seeder', ['name' => $name . 'Seeder']);
        Artisan::call('make:factory', ['name' => $name . 'Factory', '--model' => 'Models/' . $name]);
    }
}
