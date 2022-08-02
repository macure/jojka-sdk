<?php

namespace Macure\JojkaSDK\Tests;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;

class Helper
{
    /**
     * Get Handler
     *
     * @param int $status
     * @param string $body
     *
     * @return HandlerStack
     */
    public static function getMockHandler($status, $body)
    {
        $mock = new MockHandler([new Response($status, [], $body)]);

        return HandlerStack::create($mock);
    }
}
