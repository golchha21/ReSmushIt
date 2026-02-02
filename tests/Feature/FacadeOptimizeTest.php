<?php

namespace Golchha21\ReSmushIt\Tests\Feature;

use Golchha21\ReSmushIt\Tests\TestCase;
use Golchha21\ReSmushIt\Tests\Mocks\FakeReSmushIt;
use Golchha21\ReSmushIt\Facades\Optimize;

class FacadeOptimizeTest extends TestCase
{
    public function test_facade_resolves_and_runs()
    {
        $file = __DIR__ . '/../Fixtures/images/sample.jpg';
        $tmp  = sys_get_temp_dir() . '/facade-sample.jpg';

        copy($file, $tmp);

        // 🔑 THIS is the critical line
        $this->app->instance('optimize', new FakeReSmushIt());

        $result = Optimize::path($tmp);

        $this->assertArrayHasKey('dest', $result);
        $this->assertStringStartsWith('optimized-', $result['dest']);
    }
}
