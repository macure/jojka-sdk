<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Http\Response\SuccessResponse;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Success response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class SuccessResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $body = '{"successes": "done"}';;

        $response = new SuccessResponse(200, [], $body);

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
        $this->expectExceptionMessage('Deserialization of json to array failed');

        $response = new SuccessResponse(200, []);
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
        $this->expectExceptionMessage('Deserialization of json to array failed');

        $response = new SuccessResponse(200, [], 'false');
        $response->deserialize();
    }
}
