<?php

namespace App\Test;
use Illuminate\Support\Traits\Macroable;

class Greeting
{
    use Macroable;
    

    public function __construct(protected string $name)
    {
    }

    public function sayHello()
    {
        return sprintf('Hello %s%s', $this->name, PHP_EOL);
    }
}
