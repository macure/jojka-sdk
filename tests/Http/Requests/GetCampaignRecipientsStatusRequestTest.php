<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\GetCampaignRecipientsStatusRequest;

/**
 * Get campaign recipients status request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetCampaignRecipientsStatusRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing campaign id option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingCampaignIdOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "campaign_id" is missing');

        new GetCampaignRecipientsStatusRequest([]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new GetCampaignRecipientsStatusRequest([
            GetCampaignRecipientsStatusRequest::CAMPAIGN_ID => 287359,
        ]);

        $this->assertInstanceOf(GetCampaignRecipientsStatusRequest::class, $object);
    }
}
