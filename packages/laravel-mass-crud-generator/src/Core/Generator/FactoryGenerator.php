<?php

namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;

class FactoryGenerator
{
    // Properties to store faker data
    protected static $fakerDataWithType;
    protected static $fakerDataWithColumn;

    // Constructor to initialize faker data
    public function __construct()
    {
        // Load faker data from config file
        $fakerData = include __DIR__.'/../config/fakerData.php';
        // Store faker data in properties
        self::$fakerDataWithType = $fakerData['fakerDataWithType'];
        self::$fakerDataWithColumn = $fakerData['fakerDataWithColumn'];
    }

    // Generate factory file
    public function generate($name, $customStubPath, $defaultStubPath)
    {
        // Define factory file path
        $factoryPath = database_path("factories/{$name}Factory.php");
        // Determine stub file path based on custom or default path
        $stub = file_exists("{$customStubPath}/factory.stub")
            ? "{$customStubPath}/factory.stub"
            : "{$defaultStubPath}/factory.stub";

        // Define replacements for stub placeholders
        $replacements = [
            '{{modelName}}' => $name,
            '{{factoryFields}}' => $this->generateFactoryFields($name),
        ];

        // Read stub content
        $content = file_get_contents($stub);
        // Replace placeholders with actual values
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        // Write content to factory file
        file_put_contents($factoryPath, $content);
    }

    // Generate factory fields based on model columns
    protected function generateFactoryFields($model)
    {
        // Get model columns from config
       
        $columns = config("crudgenerator.tables.{$model}.columns");
        $fields = [];
        $first = true; // Flag to check if it's the first column
        $second = true; // Flag to check if it's the second column
       
        foreach ($columns as $column => $type) {
          
            // Determine faker data type for the column
            $fakerDataType = $this->getFakerDataType($type, $column);
            // Exclude the first 'id' column which auto-increments
            if ($first) {
                array_shift($fields);
                $first = false; // Update flag after first iteration
            } else {
                // Add column and faker data type to fields array
                if ($second) {
                    $fields[] = "'$column' => " . $fakerDataType; // Start from the second element
                    $second = false;
                } else {
                    $fields[] = "\t\t\t'$column' => " . $fakerDataType; // Indentation aligned with the second element
                }
            }
        }

        return implode(",\n", $fields);
    }

    // Determine faker data type based on column type
    protected function getFakerDataType($type = null, $column = null)
    {
        if ($type !== null) {
            $type = explode('|', $type)[0]; // Extract type before modifiers
        }

        // Handle 'enum' type separately
        if ($type !== null && Str::startsWith($type, 'enum')) {
            preg_match('/enum,\[(.*)\]/', $type, $matches);
            $enumValues = array_map('trim', explode(',', $matches[1]));
            return self::$fakerDataWithType['enum']($enumValues); // Call the closure with the enum values
        }

        // Check if column is provided and exists in fakerDataWithColumn
        if ($column !== null && array_key_exists($column, self::$fakerDataWithColumn)) {
            return self::$fakerDataWithColumn[$column];
        }

        // Extract the type before any modifiers
        $type = self::getTypeFromFormat($type);

        // Check if the type exists in fakerDataWithType
        if ($type !== null && array_key_exists($type, self::$fakerDataWithType)) {
            return self::$fakerDataWithType[$type];
        }

        // Default fallback
        return '$this->faker->word';
    }

    // Extract type from format (e.g., 'string|max:255' -> 'string')
    public static function getTypeFromFormat($format)
    {
        // Check if the format starts with 'enum'
        if (strpos($format, 'enum') === 0) {
            return $format; // Return empty string for 'enum' type
        }

        // Split the format by comma and return the first part
        return explode(',', $format)[0];
    }
}
