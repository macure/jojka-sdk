<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Message;
use Macure\JojkaSDK\Exceptions\DeserializationException;
use Macure\JojkaSDK\Http\Response\MessageStatusResponse;

/**
 * Message status response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageStatusResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $body = '["DELIVERED"]';

        $response = new MessageStatusResponse(200, [], $body);

        $value = $response->deserialize();

        $this->assertEquals(Message::STATUS_DELIVERED, $value);
    }

    /**
     * Test should throw exception for empty body
     *
     * @return void
     */
    public function testShouldThrowExceptionForEmptyBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage('Deserialization of json to string failed');

        $response = new MessageStatusResponse(200, []);
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
        $this->expectExceptionMessage('Deserialization of json to string failed');

        $response = new MessageStatusResponse(200, [], 'false');
        $response->deserialize();
    }
}
