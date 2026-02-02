<?php

namespace Golchha21\ReSmushIt\Tests\Unit;

use Golchha21\ReSmushIt\Tests\TestCase;

class RequestPayloadTest extends TestCase
{
    public function test_payload_contains_quality_and_exif_flags()
    {
        $payload = [
            'qlty' => config('ReSmushIt.quality'),
            'exif' => config('ReSmushIt.exif') ? 1 : 0,
        ];

        $this->assertEquals(92, $payload['qlty']);
        $this->assertEquals(0, $payload['exif']);
    }
}
