<?php

namespace Golchha21\ReSmushIt\Tests\Unit;

use Golchha21\ReSmushIt\Tests\TestCase;

class ResponseParserTest extends TestCase
{
    public function test_success_response_structure()
    {
        $response = json_decode(
            file_get_contents(__DIR__ . '/../Fixtures/responses/success.json'),
            true
        );

        $this->assertArrayHasKey('dest', $response);
        $this->assertArrayHasKey('percent', $response);
    }

    public function test_error_response_structure()
    {
        $response = json_decode(
            file_get_contents(__DIR__ . '/../Fixtures/responses/error.json'),
            true
        );

        $this->assertArrayHasKey('error', $response);
    }
}
