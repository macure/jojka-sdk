<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Campaign;
use Macure\JojkaSDK\Http\Response\CampaignResponse;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Campaign recipients response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignRecipientsStatusResponseTest extends TestCase
{
    /**
     * Test should deserialize response
     *
     * @return void
     */
    public function testShouldDeserializeResponse()
    {
        $body = '{"campaign_id": "287359"}';

        $response = new CampaignResponse(200, [], $body);

        $value = $response->deserialize();

        $this->assertInstanceOf(Campaign::class, $value);
    }

    /**
     * Test should throw exception for empty body
     *
     * @return void
     */
    public function testShouldThrowExceptionForEmptyBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage(sprintf('Deserialization of json to %s failed', Campaign::class));

        $response = new CampaignResponse(200, []);

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
        $this->expectExceptionMessage(sprintf('Deserialization of json to %s failed', Campaign::class));

        $response = new CampaignResponse(200, [], 'false');
        $response->deserialize();
    }
}
