<?php

namespace Golchha21\ReSmushIt\Tests\Feature;

use Golchha21\ReSmushIt\Tests\TestCase;
use Golchha21\ReSmushIt\Tests\Mocks\FakeReSmushIt;

class OptimizeMultiplePathsTest extends TestCase
{
    public function test_multiple_images_optimize()
    {
        $files = [
            __DIR__ . '/../Fixtures/images/sample.jpg',
            __DIR__ . '/../Fixtures/images/sample.png',
        ];

        $tempFiles = [];

        foreach ($files as $file) {
            $tmp = sys_get_temp_dir() . '/' . basename($file);
            copy($file, $tmp);
            $tempFiles[] = $tmp;
        }

        $resmushit = new FakeReSmushIt();
        $results = $resmushit->paths($tempFiles);

        $this->assertCount(2, $results);
        $this->assertArrayHasKey('dest', $results[0]);
    }
}
