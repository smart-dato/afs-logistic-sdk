<?php

namespace SmartDato\AfsLogistic\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SmartDato\AfsLogistic\AfsLogistic
 */
class AfsLogistic extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SmartDato\AfsLogistic\AfsLogistic::class;
    }
}
