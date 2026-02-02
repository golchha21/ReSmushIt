<?php

namespace Golchha21\ReSmushIt\Tests\Mocks;

class FakeResmushitClient
{
    public function optimize($payload)
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../Fixtures/responses/success.json'),
            true
        );
    }
}
