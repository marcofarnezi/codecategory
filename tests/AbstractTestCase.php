<?php
namespace CodePress\CodeCategory\Tests;

use Cviebrock\EloquentSluggable\ServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class AbstractTestCase extends TestCase
{
    public function migrate()
    {
        $this->artisan('migrate', [
            '--path' => '../../../../src/resources/migrations/'
        ]);
    }

    public function getPackageProviders($app)
    {
        return [
            ServiceProvider::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

}