<?php

namespace Frs\LaravelMassCrudGenerator\Core;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class Helper
{

    public function __construct()
    {
    }


    public static function putStatementAfterSpecificLine(string $routesPath, string $keyword, string $useStatement = null, string $routeStatement = null)
    {
        $content = file_get_contents($routesPath);

        $lines = explode("\n", $content);

        // Find the last line number that starts with 'use '
        $lastUseLine = self::lastLineNumber($lines, $keyword);

        //dd($lastUseLine+1);
        self::insertAfterLastLineNumber($routesPath,$lines,$lastUseLine, $useStatement,$keyword);
        
        // Find the last line number that starts with 'Route::'
        $lastRouteLine = self::lastLineNumber($lines, $keyword);
        
        self::insertAfterLastLineNumber($routesPath, $lines,$lastRouteLine, $routeStatement,$keyword);
    }
    

    public static function lastLineNumber($lines, $keyword)
    {
        $lastLine = -1;
        for ($i = count($lines) - 1; $i >= 0; $i--) {
            $line = trim($lines[$i]);
            if (!empty($line) && strpos($line, $keyword) === 0) {
                $lastLine = $i;
                break;
            }
        }

        return $lastLine;
    }

    public static function insertAfterLastLineNumber($routesPath,$lines,$lastLine, $statement,$keyword)
    {
        //dd($routesPath);
         // Insert the new use statement after the last 'use ' line
         if ($statement !== null) {
            if ($lastLine !== -1) {
                // Insert after the last use statement
                array_splice($lines, $lastLine + 1, 0, $statement);
               // dd($lastLine);
            } else {
                // If no use statements found, add it after the opening PHP tag
               
               if($keyword === 'use'){
                array_splice($lines, 1, 0, $statement);
               }
               if($keyword === 'Route'){
                array_splice($lines,  4, 0, $statement);
               }
            }
            $newContent = implode("\n", $lines);
            file_put_contents($routesPath, $newContent);
        }

    }

    public static function makeFolder($directory)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    public static function getColumskeyForFillableInModel($columns)
    {
        $excludeKeys = ['id', 'created_at', 'updated_at', 'deleted_at'];
        $filteredKeys = array_filter(array_keys($columns), function($key) use ($excludeKeys) {
            return !in_array($key, $excludeKeys);
        });
        // Add single quotes around each key
        $quotedKeys = array_map(function($key) {
            return "'$key'";
        }, $filteredKeys);

        // Convert the filtered and quoted keys to a comma-separated string
        $commaSeparatedKeys = implode(', ', $quotedKeys);
        return $commaSeparatedKeys;
    }

    public static function containSubstring($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    // validation rules for laravel request validation
    public static function getWordAfterDefault($string)
    {
        // Use a regular expression to match "default:" followed by the value and capture the word after it
        if (preg_match('/default:(\w+)/', $string, $matches)) {
            // Return the captured word
            return $matches[1];
        }
    
        // If no match is found, return null
        return null;
    }   
    
    public static function getTableName($name)
    {
        return Str::plural(Str::snake($name));
    }    
    
    public static function getTableNameWithForeignKey($column)
    {
        return Str::plural(strstr($column, '_', true));
    }   

    public static function generateRangeFromFloatValue($definition)
    {
        // Extract precision and scale from the definition
        preg_match('/float,(\d+),(\d+)/', $definition, $matches);

        if (count($matches) === 3) {
            $precision = $matches[1];
            $scale = $matches[2];
            // Calculate the maximum value based on precision and scale
            $maxValue = str_repeat('9', $precision - $scale) . '.' . str_repeat('9', $scale);
            return "between:0,{$maxValue}";
        } else {
            return ''; // Return an empty string if the definition doesn't match the pattern
        }
    }
}
