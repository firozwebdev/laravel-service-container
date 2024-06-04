<?php

namespace App\Test;

class Postcard
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // public static function any(){
    //     dump('inside');
    // }

    public static function resolveFacade($name){
        return app()[$name];
    }

    public static function __callStatic($method, $arguments)
    {
        //dd($method);
        return (self::resolveFacade(Postcard::class))->$method(...$arguments);
        
        // return (self::resolveFacade(Postcard::class))
        //         ->method(...$arguments); 
                
       
        //dump(app()->make(Postcard::class));
       // dump($name, $arguments);
    }
}
