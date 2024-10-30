<?php

namespace Framework\Support\Facades;

/**
 * @method static mixed json($data, $code)
 *
 * @see \Framework\Responses\Response
 */
class Response extends Facade {
    protected static function getFacadeAccessor(): string {
        return 'response';
    }
}