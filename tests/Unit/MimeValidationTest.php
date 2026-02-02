<?php

namespace Golchha21\ReSmushIt\Tests\Unit;

use Golchha21\ReSmushIt\ReSmushIt;
use Golchha21\ReSmushIt\Tests\TestCase;

class MimeValidationTest extends TestCase
{
    public function test_supported_mime_type_passes()
    {
        $resmushit = new ReSmushIt();

        $allowed = config('ReSmushIt.mime');

        $this->assertContains('image/jpeg', $allowed);
    }

    public function test_unsupported_mime_type_fails()
    {
        $allowed = config('ReSmushIt.mime');

        $this->assertNotContains('text/plain', $allowed);
    }
}
