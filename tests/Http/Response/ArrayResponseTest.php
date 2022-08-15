<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Http\Response\ArrayResponse;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Array response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ArrayResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $response = new ArrayResponse(200, [], '{"groups": [1,2,3,4]}');

        $value = $response->deserialize();

        $this->assertIsArray($value);
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

        $response = new ArrayResponse(200, []);

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

        $response = new ArrayResponse(200, [], 'true');
        $response->deserialize();
    }
}
