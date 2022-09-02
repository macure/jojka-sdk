<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Contact;
use Macure\JojkaSDK\Http\Response\ContactResponse;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Contact response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $body = '{"msisdn": "46709771337"}';

        $response = new ContactResponse(200, [], $body);

        $value = $response->deserialize();

        $this->assertInstanceOf(Contact::class, $value);
    }

    /**
     * Test should throw exception for empty body
     *
     * @return void
     */
    public function testShouldThrowExceptionForEmptyBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage(sprintf('Deserialization of json to %s failed', Contact::class));

        $response = new ContactResponse(200, []);
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
        $this->expectExceptionMessage(sprintf('Deserialization of json to %s failed', Contact::class));

        $response = new ContactResponse(200, [], 'false');
        $response->deserialize();
    }
}
