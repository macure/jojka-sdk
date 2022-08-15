<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\GetGroupsFromMsisdnRequest;

/**
 * Get groups from msisdn request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetGroupsFromMsisdnRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing msisdn option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingMsisdnOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "msisdn" is missing');

        new GetGroupsFromMsisdnRequest([]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new GetGroupsFromMsisdnRequest([
            GetGroupsFromMsisdnRequest::MSISDN => '46709771337',
        ]);

        $this->assertInstanceOf(GetGroupsFromMsisdnRequest::class, $object);
    }
}
