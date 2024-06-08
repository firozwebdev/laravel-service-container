<?php
namespace Frs\LaravelMassCrudGenerator\Core;
use Illuminate\Http\JsonResponse;

class StringProcessor
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
    

    public static function lastLineNumber($lines, $keyword) {
        
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
    public static function insertAfterLastLineNumber($routesPath,$lines,$lastLine, $statement,$keyword) {
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



}