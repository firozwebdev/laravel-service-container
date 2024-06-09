<?php

namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;

class MigrationGenerator
{
    // Generate migration file based on the provided model name
    public function generate($name, $customStubPath, $defaultStubPath)
    {
        // Define the name of the migration
        $migrationName = 'create_' . Str::plural(Str::snake($name)) . '_table';
        // Determine the stub file path based on custom or default path
        $stub = file_exists("{$customStubPath}/migration.stub")
            ? "{$customStubPath}/migration.stub"
            : "{$defaultStubPath}/migration.stub";

        // Read columns from the configuration file
        $columns = config("crudgenerator.tables.{$name}.columns", []);

        // Generate migration code for each column
        $columnsMigration = '';
        foreach ($columns as $column => $type) {
            // Initialize attributes
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

            // Add attributes to the migration code
            if ($nullable) {
                $columnMigration .= '->nullable()';
            }
            if ($default !== null) {
                $columnMigration .= "->default('{$default}')";
            }
            if ($unique) {
                $columnMigration .= '->unique()';
            }

            // Append the column migration code to the overall migration
            $columnMigration .= ";\n\t\t\t";
            $columnsMigration .= $columnMigration;
        }

        // Define replacements for stub placeholders
        $replacements = [
            '{{modelName}}' => $name,
            '{{modelNamePlural}}' => Str::camel(Str::plural($name)),
            '{{tableName}}' => Str::lower(Str::plural(Str::snake($name))),
            '{{columns}}' => $columnsMigration,
        ];

        // Read the content of the stub file
        $content = file_get_contents($stub);
        // Replace placeholders with actual values
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        // Define the path of the migration file
        $migrationPath = database_path('migrations/' . date('Y_m_d_His') . "_{$migrationName}.php");
        // Write the migration content to the migration file
        file_put_contents($migrationPath, $content);
    }
}
