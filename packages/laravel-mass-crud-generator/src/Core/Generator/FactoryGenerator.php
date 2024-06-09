<?php
namespace Frs\LaravelMassCrudGenerator\Core\Generator;
use Illuminate\Support\Str;

class FactoryGenerator
{
    protected static $fakerDataWithType;
    protected static $fakerDataWithColumn;

    public function __construct()
    {
        $fakerData = include  __DIR__.'/../config/fakerData.php';
        self::$fakerDataWithType = $fakerData['fakerDataWithType'];
        self::$fakerDataWithColumn = $fakerData['fakerDataWithColumn'];
    }

    public  function generate($name, $customStubPath, $defaultStubPath)
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
    protected   function generateFactoryFields($model)
    {
        $columns = config("crudgenerator.tables.{$model}.columns");
        $fields = [];
        $first = true; // Flag to check if it's the first column
        $second = true; // Flag to check if it's the second column

        foreach ($columns as $column => $type) {
            $fakerDataType = $this->getFakerDataType($type, $column);
            if ($first) {
                array_shift($fields); // Remove the first element id which auto increments
                $first = false; // Set the flag to false after the first iteration
            } else {
                if ($second) {
                    
                    $fields[] = "'$column' => " . $fakerDataType; // start from second element
                    $second = false;
                } else {
                    $fields[] = "\t\t\t'$column' => " . $fakerDataType; // indentation aligned with the second element
                }
            }
        }

        return implode(",\n", $fields);
    }

    protected function getFakerDataType($type = null, $column = null)
    {
        if ($type !== null) {
            $type = explode('|', $type)[0]; // Extract type before modifiers
        }
        
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
