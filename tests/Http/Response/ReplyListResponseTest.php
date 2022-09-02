<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Reply;
use Macure\JojkaSDK\Http\Response\ReplyListResponse;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Reply list response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ReplyListResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $body = '
            [
                {
                    "inserted": "2016-05-31 13:00:06",
                    "sender": "46709771337",
                    "message": "Sure"
                },
                {
                    "inserted": "2016-05-31 13:01:13",
                    "sender": "46709771337",
                    "message": "Bacon"
                }
            ]';

        $response = new ReplyListResponse(200, [], $body);

        $value = $response->deserialize();

        $this->assertContainsOnlyInstancesOf(Reply::class, $value);
    }

    /**
     * Test should throw exception for empty body
     *
     * @return void
     */
    public function testShouldThrowExceptionForEmptyBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage(sprintf('Deserialization of json to array<%s> failed', Reply::class));

        $response = new ReplyListResponse(200, []);
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
        $this->expectExceptionMessage(sprintf('Deserialization of json to array<%s> failed', Reply::class));

        $response = new ReplyListResponse(200, [], 'false');
        $response->deserialize();
    }
}
