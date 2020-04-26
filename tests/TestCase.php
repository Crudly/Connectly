<?php

namespace Crudly\Connectly\Tests;

use Crudly\Connectly\Provider;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return Crudly\Connectly\Provider
     */
    protected function getPackageProviders($app)
    {
        return [Provider::class];
    }
}
