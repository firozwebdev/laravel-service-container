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

    public static function __callStatic($name, $arguments)
    {
        dump(app()[Postcard::class]);
       // dump($name, $arguments);
    }
}
