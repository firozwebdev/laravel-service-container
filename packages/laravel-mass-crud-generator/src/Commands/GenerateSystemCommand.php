<?php

namespace Frs\LaravelMassCrudGenerator\Commands;

use Illuminate\Console\Command;
use Frs\LaravelMassCrudGenerator\Commands\GenerateBulkCrudCommand;

class GenerateSystemCommand extends Command
{
    protected $signature = 'make:system {system}';
    protected $description = 'Generate a complete CRUD system based on configuration';

    protected $bulkCrudCommand;

    public function __construct(GenerateBulkCrudCommand $bulkCrudCommand)
    {
        parent::__construct();
        $this->bulkCrudCommand = $bulkCrudCommand;
    }

    public function handle()
    {
        $system = $this->argument('system');
        $config = config('system-config.' . $system);
        

        if (!$config) {
            $this->error("Configuration for system '$system' not found.");
            return;
        }

        foreach ($config as $model => $options) {
            $names = [$model];
            $optionsString = implode('', $options['options']);
            $isApi = $options['api'] ?? false;
            $location = $options['location'] ?? null;

            $arguments = [
                'names' => $names,
                '--options' => $optionsString,
                '--location' => $location,
                '--api' => $isApi,
            ];

            $this->call('make:bulkcrud', $arguments);
        }

        $this->info("CRUD system for '$system' generated successfully.");
    }
}
