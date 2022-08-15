<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Contact;
use Macure\JojkaSDK\Http\Response\ContactListResponse;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Contact list response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactListResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $body = '[
            {
                "msisdn": "46709771337",
                "name": "Lilleman",
                "groups": [
                    "Utvecklare",
                    "Jojka personal",
                    "gruppnamn2"
                ]
            },
            {
                "msisdn": "46709966666",
                "name": "Rutger Lindquist",
                "groups": [
                    "VD"
                ]
            }
        ]';
        
        $stream = Utils::streamFor();
        $stream->write($body);

        $response = new ContactListResponse(200, [], $stream);

        $value = $response->deserialize();

        $this->assertContainsOnlyInstancesOf(Contact::class, $value);
    }

    /**
     * Test should throw exception for empty body
     *
     * @return void
     */
    public function testShouldThrowExceptionForEmptyBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage(sprintf('Deserialization of json to array<%s> failed', Contact::class));

        $response = new ContactListResponse(200, []);

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
        $this->expectExceptionMessage(sprintf('Deserialization of json to array<%s> failed', Contact::class));

        $response = new ContactListResponse(200, [], 'false');
        $response->deserialize();
    }
}
