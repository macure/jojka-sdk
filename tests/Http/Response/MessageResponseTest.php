<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Message;
use Macure\JojkaSDK\Http\Response\MessageResponse;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Message response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $body = '{"message_id": "6223c1c6079e9c21b5901d63"}';

        $response = new MessageResponse(200, [], $body);

        $value = $response->deserialize();

        $this->assertInstanceOf(Message::class, $value);
    }

    /**
     * Test should throw exception for empty body
     *
     * @return void
     */
    public function testShouldThrowExceptionForEmptyBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage(sprintf('Deserialization of json to %s failed', Message::class));

        $response = new MessageResponse(200, []);
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
        $this->expectExceptionMessage(sprintf('Deserialization of json to %s failed', Message::class));

        $response = new MessageResponse(200, [], 'false');
        $response->deserialize();
    }
}
