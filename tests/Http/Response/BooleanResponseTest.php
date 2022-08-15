<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Http\Response\BooleanResponse;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Boolean response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class BooleanResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $response = new BooleanResponse(200, [], "true");

        $value = $response->deserialize();

        $this->assertIsBool($value);
    }

    /**
     * Test should throw exception for empty body
     *
     * @return void
     */
    public function testShouldThrowExceptionForEmptyBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage('Deserialization of json to bool failed');

        $response = new BooleanResponse(200, []);

        $response->deserialize();
    }

    /**
     * Test should throw exception for invalid body
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage('Deserialization of json to bool failed');

        $response = new BooleanResponse(200, [], '{"true"}');
        $response->deserialize();
    }
}
