<?php

namespace Golchha21\ReSmushIt\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Golchha21\ReSmushIt\Providers\ServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('ReSmushIt', [
            'original'   => true,
            'quality'    => 92,
            'mime'       => [
                'image/png',
                'image/jpeg',
                'image/gif',
                'image/bmp',
                'image/tiff',
            ],
            'useragent'  => 'ReSmushIt-Test-Agent',
            'exif'       => false,
        ]);
    }
}
