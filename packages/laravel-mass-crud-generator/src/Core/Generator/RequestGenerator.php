<?php

namespace Frs\LaravelMassCrudGenerator\Core\Generator;

use Illuminate\Support\Str;
use Frs\LaravelMassCrudGenerator\Core\Helper;

class RequestGenerator
{
    // Generate the request file
    public function generate($name, $customStubPath, $defaultStubPath)
    {
        // Define the directory path for requests
        $requestDirectory = app_path("Http/Requests");
        
        // Create the directory if it doesn't exist
        Helper::makeFolder($requestDirectory);

        // Define the path to the request file
        $requestPath = app_path("Http/Requests/{$name}Request.php");
        
        // Determine the stub file path based on custom or default path
        $stub = file_exists("{$customStubPath}/request.stub")
            ? "{$customStubPath}/request.stub"
            : "{$defaultStubPath}/request.stub";

        // Define replacements for stub placeholders
        $replacements = [
            '{{modelName}}' => $name,
            '{{validationRules}}' => $this->generateValidationRules($name),
        ];

        // Read the content of the stub file
        $content = file_get_contents($stub);
        
        // Replace placeholders with actual values
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        
        // Write the request content to the request file
        file_put_contents($requestPath, $content);
    }

    // Generate validation rules from the configuration file
    private function generateValidationRules($name)
{
    $config = include base_path('config/crudgenerator.php');
    $columns = $config['tables'][$name]['columns'] ?? [];

    $rules = [];
    foreach ($columns as $column => $definition) {
        
        // Skip columns that should be avoided
        if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
            continue;
        }

        $ruleSet = $this->parseDefinition($definition,$column,$name);
        
        if ($ruleSet) {
            $rules[] = "'$column' => '$ruleSet'";
        }
        //dd($rules);
    }
    if(!empty($rules) && count($rules) > 1){
        return implode(",\n\t\t\t", $rules);
    }
    return implode(",\n", $rules);
}


    // Parse the column definition to extract validation rules
    // private function parseDefinition($definition)
    // {
    //     $rules = [];
    
    //     // Check for 'required' and 'nullable'
    //     if (Str::contains($definition, 'required')) {
    //         $rules[] = 'required';
    //     } elseif (Str::contains($definition, 'nullable')) {
    //         $rules[] = 'nullable';
    //     }
    
    //     // Check for 'unique'
    //     if (Str::contains($definition, 'unique')) {
    //         $rules[] = 'unique';
    //     }
    
    //     // Check for data types
    //     if (Str::contains($definition, 'string')) {
    //         $rules[] = 'string';
    //         if (!Str::contains($definition, ['min', 'max'])) {
    //             // Use regex to find the maximum length after 'string,'
    //             preg_match('/string,(\d+)/', $definition, $matches);
    //             if (isset($matches[1])) {
    //                 $maxLength = $matches[1];
    //                 $rules[] = "max:{$maxLength}";
    //             }
    //         }
    //     } elseif (Str::contains($definition, 'integer')) {
    //         $rules[] = 'integer';
    //     } elseif (Str::contains($definition, 'numeric')) {
    //         $rules[] = 'numeric';
    //     } elseif (Str::contains($definition, 'boolean')) {
    //         $rules[] = 'boolean';
    //     } elseif (Str::contains($definition, 'array')) {
    //         $rules[] = 'array';
    //     } elseif (Str::contains($definition, 'json')) {
    //         $rules[] = 'json';
    //     } elseif (Str::contains($definition, 'date')) {
    //         $rules[] = 'date';
    //     }
    
    //     // Check for specific validations
    //     if (Str::contains($definition, 'email')) {
    //         $rules[] = 'email';
    //     }
    //     if (Str::contains($definition, 'url')) {
    //         $rules[] = 'url';
    //     }
    //     if (Str::contains($definition, 'image')) {
    //         $rules[] = 'image'; // Validates that the file is an image (jpeg, png, bmp, gif, or svg)
    //     }
    
    //     // Check for file validations
    //     if (Str::contains($definition, 'mimes')) {
    //         // Extract allowed file types from definition
    //         $fileTypes = Str::between($definition, 'mimes:[', ']');
    //         $rules[] = "mimes:{$fileTypes}"; // Validates that the file has one of the specified MIME types
    //     }
    //     if (Str::contains($definition, 'max')) {
    //         // Extract maximum file size from definition
    //         $maxSize = Str::after($definition, 'max:');
    //         $rules[] = "max:{$maxSize}"; // Validates that the file size does not exceed the specified maximum size in kilobytes
    //     }
    //     if (Str::contains($definition, 'dimensions')) {
    //         // Extract dimensions from definition
    //         $dimensions = Str::between($definition, 'dimensions:', '|');
    //         $rules[] = "dimensions:{$dimensions}"; // Validates the dimensions of an image file
    //     }
    
    //     //Check for 'in' rule
    //     if (Str::contains($definition, 'in')) {
    //         // Extract comma-separated values from definition
    //         $values = Str::between($definition, '[', ']');
    //         if (!Str::contains($values, 'string')) {
    //             $rules[] = "in:{$values}";
    //         }
    //     }

       
    
    //     // Check for date format rule
    //     if (Str::contains($definition, 'date_format')) {
    //         // Extract date format from definition
    //         $dateFormat = Str::after($definition, 'date_format:');
    //         $rules[] = "date_format:{$dateFormat}";
    //     }
    
    //     // Check for 'before' and 'after' date rules
    //     if (Str::contains($definition, 'before')) {
    //         // Extract date value from definition
    //         $dateValue = Str::after($definition, 'before:');
    //         $rules[] = "before:{$dateValue}";
    //     }
    //     if (Str::contains($definition, 'after')) {
    //         // Extract date value from definition
    //         $dateValue = Str::after($definition, 'after:');
    //         $rules[] = "after:{$dateValue}";
    //     }
    
    //     return implode('|', $rules);
    // }
    
    private function parseDefinition($definition,$column,$name)
    {
        
        $rules = [];
    
        // Avoid specific fields
        $avoidFields = ['id', 'created_at', 'updated_at', 'deleted_at'];
    
        if (in_array($definition, $avoidFields)) {
            return '';
        }

       
        
    
        // Check for 'nullable'
        if (Str::contains($definition, 'nullable')) {
            $rules[] = 'nullable';
        }else{
            $rules[] = 'required';
        } 

        // Check for 'required'
        if(Str::contains($definition, 'required')) {
            $rules[] = 'required';
        }

        // Check for 'unique'
        $tableName = Helper::getTableName($name);
        if (Str::contains($definition, 'unique')) {
            $rules[] = 'unique:'.$tableName.','.$column;
        }
         // Check for 'text'
        if (Str::contains($definition, 'text')) {
            $rules[] = 'string';
        }

        // check foreignId
        $tableNameWithForeignKey = Helper::getTableNameWithForeignKey($column);
        if (Str::contains($definition, 'foreignId')) {
            $rules[] = 'integer|exists:'.$tableNameWithForeignKey.',id';
        }
        
        // Check for data types
        if (Str::contains($definition, 'string')) {
            $rules[] = 'string';
            // Use regex to find the maximum length after 'string,'
            preg_match('/string,(\d+)/', $definition, $matches);
            if (isset($matches[1])) {
                $maxLength = $matches[1];
                $rules[] = "max:{$maxLength}";
            }
        } elseif (Str::contains($definition, 'integer')) {
            $rules[] = 'integer|min:1';
        } elseif (Str::contains($definition, 'float')) {
            $rangeValue = Helper::generateRangeFromFloatValue($definition);
            $rules[] = 'numeric|'.$rangeValue;
        } elseif (Str::contains($definition, 'numeric')) {
            $rules[] = 'numeric';
        } elseif (Str::contains($definition, 'boolean')) {
            $rules[] = 'boolean';
        } elseif (Str::contains($definition, 'array')) {
            $rules[] = 'array';
        } elseif (Str::contains($definition, 'json')) {
            $rules[] = 'json';
        } elseif (Str::contains($definition, 'date')) {
            $rules[] = 'date';
        }
    
        // Check for specific validations
        if (Str::contains($definition, 'email')) {
            $rules[] = 'email';
        }
        if (Str::contains($definition, 'url')) {
            $rules[] = 'url';
        }
        if (Str::contains($definition, 'image')) {
            $rules[] = 'mimes:jpg,png|max:2048'; // Validates that the file is an image (jpeg, png, bmp, gif, or svg)
        }
    
        // Check for file validations
        if (Str::contains($definition, 'mimes')) {
            // Extract allowed file types from definition
            $fileTypes = Str::between($definition, 'mimes:[', ']');
            $rules[] = "{$fileTypes}"; // Validates that the file has one of the specified MIME types
        }
        if (Str::contains($definition, 'max')) {
            // Extract maximum file size from definition
            $maxSize = Str::after($definition, 'max:');
            $rules[] = "{$maxSize}"; // Validates that the file size does not exceed the specified maximum size in kilobytes
        }
        if (Str::contains($definition, 'dimensions')) {
            // Extract dimensions from definition
            $dimensions = Str::between($definition, 'dimensions:', '|');
            $rules[] = "dimensions:{$dimensions}"; // Validates the dimensions of an image file
        }
    
        // Check for 'in' rule
        // if (Str::contains($definition, 'in')) {
        //     // Extract comma-separated values from definition
        //     $values = Str::between($definition, '[', ']');
        //     if (!Str::contains($definition, 'string')) {
        //         $rules[] = "in:{$values}";
        //     }
        // }

        // Check for 'enum' to define a list of acceptable values
        if (Str::contains($definition, 'enum')) {
            // Extract comma-separated values from definition
            $values = Str::between($definition, '[', ']');
            $rules[] = "in:{$values}";
        }
    
        // Check for date format rule
        if (Str::contains($definition, 'date_format')) {
            // Extract date format from definition
            $dateFormat = Str::after($definition, 'date_format:');
            $rules[] = "date_format:{$dateFormat}";
        }
    
        // Check for 'before' and 'after' date rules
        if (Str::contains($definition, 'before')) {
            // Extract date value from definition
            $dateValue = Str::after($definition, 'before:');
            $rules[] = "before:{$dateValue}";
        }
        if (Str::contains($definition, 'after')) {
            // Extract date value from definition
            $dateValue = Str::after($definition, 'after:');
            $rules[] = "after:{$dateValue}";
        }
        //dd($rules);
        if(!empty($rules) && count($rules) > 0){
            return implode('|', $rules);
        }else{
            return implode($rules);
        }
       
    }
    
    
    



}
