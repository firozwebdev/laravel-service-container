<?php
namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;


class MigrationGenerator{
    public  function generate($name, $customStubPath, $defaultStubPath)
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
}