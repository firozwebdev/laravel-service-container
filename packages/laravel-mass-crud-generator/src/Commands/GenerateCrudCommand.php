<?php
namespace Frs\LaravelMassCrudGenerator\Commands;

use Frs\LaravelMassCrudGenerator\Core\Helper;
use Illuminate\Support\Str;
use Illuminate\Console\Command;


class GenerateCrudCommand extends Command
{
    protected $signature = 'make:crud {name} {options?} {--location=} {--api : Generate API response in controller}';
    protected $description = 'Generate CRUD operations for a single model';

    public function handle()
    {
        $name = $this->argument('name');
        $isApi = $this->option('api');
        $combinedOptions = $this->argument('options') ?: '';
        $controllerPath = $this->option('location');
        $parsedOptions = $this->parseCombinedOptions($combinedOptions);

        $this->generateCrudForModel($name, $parsedOptions, $isApi, $controllerPath);
    }

    protected function parseCombinedOptions($combinedOptions)
    {
        $options = ['mi', 'm', 'c', 's', 'f', 'r'];
        $parsedOptions = array_fill_keys($options, false);

        $pattern = '/' . implode('|', array_map(function ($option) {
            return preg_quote($option, '/');
        }, $options)) . '/';

        preg_match_all($pattern, $combinedOptions, $matches);

        foreach ($matches[0] as $match) {
            $parsedOptions[$match] = true;
        }

        return $parsedOptions;
    }

    protected function generateCrudForModel($name, $parsedOptions, $isApi, $controllerPath)
    {
        $customStubPath = resource_path('stubs/vendor/crudgenerator');
        $defaultStubPath = __DIR__ . '/../defaults/stubs';

        $noOptions = !array_filter($parsedOptions);

        if ($noOptions || !$parsedOptions) {
            $this->generateModel($name, $customStubPath, $defaultStubPath);
            $this->generateMigration($name, $customStubPath, $defaultStubPath);
            $this->generateController($name, $customStubPath, $defaultStubPath, $isApi, $controllerPath);
            $this->generateSeeder($name, $customStubPath, $defaultStubPath);
            $this->generateFactory($name, $customStubPath, $defaultStubPath);
            $this->generateRequest($name, $customStubPath, $defaultStubPath);
            //$this->generateRoutes($name, $customStubPath, $defaultStubPath);
            $this->generateRoutes($name, $isApi, $controllerPath);
            $this->info("{$name} CRUD generated successfully.");
        } else {
            if ($parsedOptions['mi']) {
                $this->generateMigration($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Migration created successfully.");
            }

            if ($parsedOptions['m']) {
                $this->generateModel($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Model created successfully.");
            }

            if ($parsedOptions['c']) {
                $this->generateRoutes($name, $customStubPath, $defaultStubPath);
                $this->generateController($name, $customStubPath, $defaultStubPath, $isApi, $controllerPath);
                $this->info("{$name} Controller created successfully.");
            }

            if ($parsedOptions['s']) {
                $this->generateSeeder($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Seeder created successfully.");
            }

            if ($parsedOptions['f']) {
                $this->generateFactory($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Factory created successfully.");
            }

            if ($parsedOptions['r']) {
                $this->generateRequest($name, $customStubPath, $defaultStubPath);
                $this->info("{$name} Request created successfully.");
            }
        }
    }

    protected function generateModel($name, $customStubPath, $defaultStubPath)
    {
        $modelPath = app_path("Models/{$name}.php");
        $stub = file_exists("{$customStubPath}/model.stub") ? "{$customStubPath}/model.stub" : "{$defaultStubPath}/model.stub";
        $columns = config("crudgenerator.tables.{$name}.columns", []);
        $columnsKey = Helper::getColumskeyForFillableInModel($columns);
        
        $replacements = [
            '{{modelName}}' => $name,
            '{{columnsKey}}' => $columnsKey,
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($modelPath, $content);
    }

    protected function generateController($name, $customStubPath, $defaultStubPath, $isApi, $controllerPath)
    {
        $controllerNamespace = 'App\\Http\\Controllers';
        if ($controllerPath) {
            $controllerNamespace .= '\\' . str_replace('/', '\\', trim($controllerPath, '/'));
            $controllerPath = 'Http/Controllers/' . trim($controllerPath, '/');
            $onlyControllerNamespace = 'use App\Http\Controllers\Controller;';
        } else {
            $controllerPath = 'Http/Controllers';
            $onlyControllerNamespace = '';
        }

        $controllerDirectory = app_path($controllerPath);
        Helper::makeFolder($controllerDirectory);

        $controllerFilePath = app_path("{$controllerPath}/{$name}Controller.php");
        $stub = $isApi
            ? (file_exists("{$customStubPath}/api_controller.stub") ? "{$customStubPath}/api_controller.stub" : "{$defaultStubPath}/api_controller.stub")
            : (file_exists("{$customStubPath}/controller.stub") ? "{$customStubPath}/controller.stub" : "{$defaultStubPath}/controller.stub");

        $replacements = [
            '{{controllerNamespace}}' => $controllerNamespace,
            '{{onlyControllerNamespace}}' => $onlyControllerNamespace,
            '{{controllerName}}' => "{$name}Controller",
            '{{modelVariable}}' => Str::camel(Str::singular($name)),
            '{{modelVariables}}' => Str::camel(Str::plural($name)),
            '{{modelName}}' => $name,
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($controllerFilePath, $content);
    }

    protected function generateMigration($name, $customStubPath, $defaultStubPath)
    {
        $migrationName = 'create_' . Str::plural(Str::snake($name)) . '_table';
        $stub = file_exists("{$customStubPath}/migration.stub") ? "{$customStubPath}/migration.stub" : "{$defaultStubPath}/migration.stub";

        // Read columns from the configuration file
        $columns = config("crudgenerator.tables.{$name}.columns", []);

        $columnsMigration = '';
        foreach ($columns as $column => $type) {
            $nullable = false;
            $default = null;
            $unique = false;

            // Check for nullable attribute
            if (strpos($type, '|nullable') !== false) {
                $nullable = true;
                $type = str_replace('|nullable', '', $type);
            }

            // Check for default value
            if (preg_match('/\|default:(.*)/', $type, $matches)) {
                $default = $matches[1];
                $type = str_replace('|default:' . $default, '', $type);
            }

            // Check for unique attribute
            if (strpos($type, '|unique') !== false) {
                $unique = true;
                $type = str_replace('|unique', '', $type);
            }

            // Parse type and arguments
            $typeParts = explode(',', $type);
            $typeName = array_shift($typeParts);
            $typeArgs = !empty($typeParts) ? implode(', ', $typeParts) : '';

            // Handle enum separately
            if ($typeName == 'enum') {
                $enumValues = explode(',', trim($typeArgs, '[]'));
                $enumValues = array_map('trim', $enumValues);
                $enumValues = array_map(function ($val) {
                    return "'$val'";
                }, $enumValues);
                $enumValuesString = implode(',', $enumValues);
                $columnMigration = "\$table->enum('{$column}', [{$enumValuesString}])";
            } else {
                $columnMigration = $typeArgs
                    ? "\$table->{$typeName}('{$column}', {$typeArgs})"
                    : "\$table->{$typeName}('{$column}')";
            }

            if ($nullable) {
                $columnMigration .= '->nullable()';
            }
            if ($default !== null) {
                $columnMigration .= "->default('{$default}')";
            }
            if ($unique) {
                $columnMigration .= '->unique()';
            }

            $columnMigration .= ";\n\t\t\t";
            $columnsMigration .= $columnMigration;
        }

        $replacements = [
            '{{modelName}}' => $name,
            '{{modelNamePlural}}' => Str::camel(Str::plural($name)),
            '{{tableName}}' => Str::lower(Str::plural(Str::snake($name))),
            '{{columns}}' => $columnsMigration,
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        $migrationPath = database_path('migrations/' . date('Y_m_d_His') . "_{$migrationName}.php");
        file_put_contents($migrationPath, $content);
    }


    protected function generateSeeder($name, $customStubPath, $defaultStubPath)
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

    protected function generateFactory($name, $customStubPath, $defaultStubPath)
    {
        $factoryPath = database_path("factories/{$name}Factory.php");
        $stub = file_exists("{$customStubPath}/factory.stub") ? "{$customStubPath}/factory.stub" : "{$defaultStubPath}/factory.stub";

        $replacements = [
            '{{modelName}}' => $name,
            '{{factoryFields}}' => $this->generateFactoryFields($name),
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($factoryPath, $content);
    }

    protected function generateFactoryFields($model)
    {
        $columns = config("crudgenerator.tables.{$model}.columns");
        $fields = [];
        $first = true; // Flag to check if it's the first column
        $second = true; // Flag to check if it's the second column

        foreach ($columns as $column => $type) {
            if ($first) {
                array_shift($fields); // Remove the first element id which auto increments
                $first = false; // Set the flag to false after the first iteration
               
            }else {
                if($second){
                    $fields[] = "'$column' => " . $this->getFakerDataType(Helper::getTypeFromFormat($type)); // start from second element
                    $second = false;
                }else{
                    $fields[] = "\t\t\t'$column' => " . $this->getFakerDataType(Helper::getTypeFromFormat($type)); // indentation aligned with the second element
                }
               
            }
        }

        return implode(",\n", $fields);
    }

   

    protected function getFakerDataType($type)
    {
        $type = explode('|', $type)[0]; // Extract type before modifiers
        dump($type);
        $fakerData = [
            'increments' => '$this->faker->unique()->randomNumber()',
            'foreignId' => '$this->faker->numberBetween(1, 50)',
            'string' => '$this->faker->sentence()',
            'text' => '$this->faker->paragraph()',
            'integer' => '$this->faker->numberBetween(0, 100)',
            'float' => '$this->faker->randomFloat(2, 0, 1000)',
            'decimal' => '$this->faker->randomFloat(2, 0, 1000)',
            'boolean' => '$this->faker->boolean()',
            'date' => '$this->faker->date()',
            'time' => '$this->faker->time()',
            'datetime' => '$this->faker->dateTime()',
            'timestamp' => '$this->faker->dateTime()',
            'year' => '$this->faker->year()',
            'month' => '$this->faker->month()',
            'day' => '$this->faker->dayOfMonth()',
            'enum' => function($elements) {
                return '$this->faker->randomElement(' . json_encode($elements) . ')';
            },
            'phone' => '$this->faker->phoneNumber()',
            'cell' => '$this->faker->e164PhoneNumber()',
            'email' => '$this->faker->unique()->safeEmail()',
            'url' => '$this->faker->url()',
            'ipAddress' => '$this->faker->ipv4()',
            'macAddress' => '$this->faker->macAddress()',
            'uuid' => '$this->faker->uuid()',
            'password' => '$this->faker->password()',
            'color' => '$this->faker->safeColorName()',
            'country' => '$this->faker->country()',
            'city' => '$this->faker->city()',
            'streetAddress' => '$this->faker->streetAddress()',
            'postcode' => '$this->faker->postcode()',
            'latitude' => '$this->faker->latitude()',
            'longitude' => '$this->faker->longitude()',
            'company' => '$this->faker->company()',
            'jobTitle' => '$this->faker->jobTitle()',
            'creditCardNumber' => '$this->faker->creditCardNumber()',
            'iban' => '$this->faker->iban()',
            'currencyCode' => '$this->faker->currencyCode()',
            'languageCode' => '$this->faker->languageCode()',
        ];
    
        if (Str::startsWith($type, 'enum')) {
            preg_match('/enum,\[(.*)\]/', $type, $matches);
            $enumValues = array_map('trim', explode(',', $matches[1]));
            return $fakerData['enum']($enumValues); // Call the closure with the enum values
        }
    
        return $fakerData[$type] ?? '$this->faker->word';
    }
    


    protected function generateRequest($name, $customStubPath, $defaultStubPath)
    {
        $requestDirectory = app_path("Http/Requests");
        Helper::makeFolder($requestDirectory);

        $requestPath = app_path("Http/Requests/{$name}Request.php");
        $stub = file_exists("{$customStubPath}/request.stub") ? "{$customStubPath}/request.stub" : "{$defaultStubPath}/request.stub";

        $replacements = [
            '{{modelName}}' => $name,
        ];

        $content = file_get_contents($stub);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        file_put_contents($requestPath, $content);
    }


    protected function generateRoutes($name, $isApi, $controllerPath)
    {
        $routesPath = base_path('routes/web.php');
        if ($isApi) {
            $routesPath = base_path('routes/api.php');
        }

        $routeName = Str::kebab(Str::plural($name));
        $controllerName = "{$name}Controller";
        
        // Default namespace
        $controllerNamespace = 'App\\Http\\Controllers';
        if ($controllerPath) {
            $controllerNamespace .= '\\' . str_replace('/', '\\', trim($controllerPath, '/'));
        }

        $useStatement = "use {$controllerNamespace}\\{$controllerName};";
        
        $routeDefinition = $isApi 
            ? "Route::apiResource('{$routeName}', {$controllerName}::class);" 
            : "Route::resource('{$routeName}', {$controllerName}::class);";

        // Read the content of the routes file
       
        Helper::putStatementAfterSpecificLine($routesPath,'use',$useStatement);
        Helper::putStatementAfterSpecificLine($routesPath,'Route',$routeDefinition);

        $this->info("Routes for {$name} added successfully.");
    }

    

}
