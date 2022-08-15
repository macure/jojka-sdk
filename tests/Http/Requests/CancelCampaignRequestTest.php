<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\CancelCampaignRequest;

/**
 * Cancel campaign request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CancelCampaignRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing campaign_id option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingCampaignIdOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "campaign_id" is missing');

        new CancelCampaignRequest([]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new CancelCampaignRequest([
            CancelCampaignRequest::CAMPAIGN_ID => 287359,
        ]);

        $this->assertInstanceOf(CancelCampaignRequest::class, $object);
    }
}