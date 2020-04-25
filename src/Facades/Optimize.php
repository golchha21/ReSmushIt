<?php

namespace Golchha21\ReSmushIt\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static path(string $file)
 * @method static paths(array $files)
 */
class Optimize extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'optimize';
    }
}
