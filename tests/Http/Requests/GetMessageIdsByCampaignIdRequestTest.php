<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\GetMessageIdsByCampaignIdRequest;

/**
 * Get message ids by campaign id request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetMessageIdsByCampaignIdRequestTest extends TestCase
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

        new GetMessageIdsByCampaignIdRequest([]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new GetMessageIdsByCampaignIdRequest([
            GetMessageIdsByCampaignIdRequest::CAMPAIGN_ID => 287359,
        ]);

        $this->assertInstanceOf(GetMessageIdsByCampaignIdRequest::class, $object);
    }
}
