<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Http\Requests\AddCampaignRequest;
use Macure\JojkaSDK\Exceptions\InvalidOptionsException;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;

/**
 * Add campaign request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddCampaignRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing msg option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingMsgOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "msg" is missing');

        new AddCampaignRequest([]);
    }

    /**
     * Test should throw exception for missing msisdn or group option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingMsisdnOrGroupOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('Both to_msisdn, to_group are null or both are provided');

        new AddCampaignRequest([
            AddCampaignRequest::MSG => 'hello'     
        ]);
    }

    /**
     * Test should throw exception for invalid from option
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidFromOption()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('Optional parameter from is restricted to a-z, A-Z, 0-9 and separators such as - and _. Max 11 characters');

        new AddCampaignRequest([
            AddCampaignRequest::MSG       => 'hello',
            AddCampaignRequest::TO_MSISDN => '46709771337;46709966666',
            AddCampaignRequest::FROM      => 'Name Surname'
        ]);
    }

    /**
     * Test should throw exception for invalid scheduled option
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidScheduledOption()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('Optional parameter scheduled must be given in the format "Y-m-d H:i:s"');

        new AddCampaignRequest([
            AddCampaignRequest::MSG       => 'hello',
            AddCampaignRequest::TO_MSISDN => '46709771337;46709966666',
            AddCampaignRequest::FROM      => 'NameSurname',
            AddCampaignRequest::SCHEDULED => '2016/05/31 12:18:52',
        ]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new AddCampaignRequest([
            AddCampaignRequest::MSG       => 'hello',
            AddCampaignRequest::TO_MSISDN => '46709771337;46709966666',
            AddCampaignRequest::FROM      => 'NameSurname',
            AddCampaignRequest::SCHEDULED => '2016-05-31 12:18:52'
        ]);

        $this->assertInstanceOf(AddCampaignRequest::class, $object);
    }
}
