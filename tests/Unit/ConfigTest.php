<?php

namespace Golchha21\ReSmushIt\Tests\Unit;

use Golchha21\ReSmushIt\Tests\TestCase;

class ConfigTest extends TestCase
{
    public function test_default_config_is_loaded()
    {
        $config = config('ReSmushIt');

        $this->assertIsArray($config);
        $this->assertArrayHasKey('quality', $config);
        $this->assertArrayHasKey('mime', $config);
    }

    public function test_quality_is_integer()
    {
        $this->assertIsInt(config('ReSmushIt.quality'));
    }

    public function test_mime_is_array()
    {
        $this->assertIsArray(config('ReSmushIt.mime'));
    }
}
