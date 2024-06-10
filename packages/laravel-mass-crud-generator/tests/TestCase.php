<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Frs\LaravelMassCrudGenerator\Providers\SingleCrudServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            SingleCrudServiceProvider::class,
        ];
    }
}
