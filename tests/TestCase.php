<?php

namespace Hyvor\HyvorConnecter\Tests;

use Hyvor\HyvorConnecter\HyvorConnecterServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app)
    {
        return [
            HyvorConnecterServiceProvider::class,
        ];
    }

}