<?php

namespace Golchha21\ReSmushIt\Tests\Mocks;

use Golchha21\ReSmushIt\ReSmushIt;

class FakeReSmushIt extends ReSmushIt
{
    protected function optimizeFile(string $file): array
    {
        return [
            'src'         => basename($file),
            'dest'        => 'optimized-' . basename($file),
            'percent'     => 42,
            'size_before' => 100000,
            'size_after'  => 58000,
        ];
    }
}
