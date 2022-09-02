<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\RemoveContactFromGroupRequest;

/**
 * Remove contact from group request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class RemoveContactFromGroupRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing options
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingOptions()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required options "group", "msisdn" are missing.');

        new RemoveContactFromGroupRequest([]);
    }

    /**
     * Test should throw exception for missing msisdn option
     
     * @return void
     */
    public function testShouldThrowExceptionForMissingMsisdnOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "msisdn" is missing.');

        new RemoveContactFromGroupRequest([
            RemoveContactFromGroupRequest::GROUP => 'Utvecklare'
        ]);
    }

    /**
     * Test should throw exception for missing group option
     
     * @return void
     */
    public function testShouldThrowExceptionForMissingGroupOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "group" is missing.');

        new RemoveContactFromGroupRequest([
            RemoveContactFromGroupRequest::MSISDN => '46709771337'
        ]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new RemoveContactFromGroupRequest([
            RemoveContactFromGroupRequest::MSISDN => '46709771337',
            RemoveContactFromGroupRequest::GROUP  => 'Utvecklare'
        ]);

        $this->assertInstanceOf(RemoveContactFromGroupRequest::class, $object);
    }
}