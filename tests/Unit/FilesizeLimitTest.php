<?php

namespace Golchha21\ReSmushIt\Tests\Unit;

use Golchha21\ReSmushIt\Tests\TestCase;
use Golchha21\ReSmushIt\ReSmushIt;

class FilesizeLimitTest extends TestCase
{
    public function test_file_exceeding_max_filesize_is_rejected()
    {
        // Set a very small filesize limit (1 KB)
        config()->set('ReSmushIt.max_filesize', 1024);

        // Create a temporary file larger than the limit
        $file = __DIR__ . '/../Fixtures/images/sample.png';

        $resmushit = new ReSmushIt();
        $result = $resmushit->path($file);

        // Assertions
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('File size exceeds the allowed limit', $result['error']);
        $this->assertEquals(1024, $result['limit']);
        $this->assertGreaterThan($result['limit'], $result['size']);

    }
}
