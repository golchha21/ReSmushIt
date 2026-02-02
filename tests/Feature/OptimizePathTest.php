<?php

namespace Golchha21\ReSmushIt\Tests\Feature;

use Golchha21\ReSmushIt\Tests\TestCase;
use Golchha21\ReSmushIt\Tests\Mocks\FakeReSmushIt;

class OptimizePathTest extends TestCase
{
    public function test_single_image_path_optimizes()
    {
        $file = __DIR__ . '/../Fixtures/images/sample.jpg';
        $tmp  = sys_get_temp_dir() . '/sample.jpg';

        copy($file, $tmp);

        $resmushit = new FakeReSmushIt();
        $result = $resmushit->path($tmp);

        $this->assertArrayHasKey('dest', $result);
        $this->assertEquals('optimized-sample.jpg', $result['dest']);
    }
}
