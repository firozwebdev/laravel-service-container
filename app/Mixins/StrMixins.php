<?php

namespace App\Mixins;


class StrMixins
{
    function partNumber(){
       return function($part){
         return 'Other-'.substr($part,0,3).'-'.substr($part,3);
       };
    }

    function prefix(){
        return function($string, $prefix='AB-'){
            return $prefix.$string;
            
        };
    }
}