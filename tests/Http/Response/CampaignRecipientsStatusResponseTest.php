<?php

namespace Macure\JojkaSDK\Tests\Http\Response;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\CampaignRecipientsStatus;
use Macure\JojkaSDK\Exceptions\DeserializationException;
use Macure\JojkaSDK\Http\Response\CampaignRecipientsStatusResponse;

/**
 * Campaign response test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignResponseTest extends TestCase
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
                        "receiver":   "467352xxxxx",
                        "message_id": "1900607",
                        "status":     "DELIVERED"
                    },
                    {
                        "receiver":   "4670903xxxxxx",
                        "message_id": "1925062",
                        "status":     "ERROR"
                    },
                    {
                        "receiver":   "4670903xxxxxx",
                        "message_id": "1925062",
                        "status":     "SENT"
                    }
                ]';

        $response = new CampaignRecipientsStatusResponse(200, [], $body);

        $value = $response->deserialize();

        $this->assertContainsOnlyInstancesOf(CampaignRecipientsStatus::class, $value);
    }

    /**
     * Test should throw exception for empty body
     *
     * @return void
     */
    public function testShouldThrowExceptionForEmptyBody()
    {
        $this->expectException(DeserializationException::class);
        $this->expectExceptionMessage(sprintf('Deserialization of json to array<%s> failed', CampaignRecipientsStatus::class));

        $response = new CampaignRecipientsStatusResponse(200, []);

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
        $this->expectExceptionMessage(sprintf('Deserialization of json to array<%s> failed', CampaignRecipientsStatus::class));

        $response = new CampaignRecipientsStatusResponse(200, [], 'false');
        $response->deserialize();
    }
}
