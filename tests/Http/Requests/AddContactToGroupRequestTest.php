<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\AddContactToGroupRequest;

/**
 * Add contact to group request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddContactToGroupRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing msisdn and group option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingMsisdnAndGroupOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required options "group", "msisdn" are missing');

        new AddContactToGroupRequest([]);
    }

    /**
     * Test should throw exception for missing msisdn option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingMsisdnOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "msisdn" is missing');

        new AddContactToGroupRequest([
            AddContactToGroupRequest::GROUP => 'gruppnamn2'
        ]);
    }

    /**
     * Test should throw exception for missing group option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingGroupOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "group" is missing');

        new AddContactToGroupRequest([
            AddContactToGroupRequest::MSISDN => '46709771337'
        ]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new AddContactToGroupRequest([
            AddContactToGroupRequest::MSISDN => '46709771337',
            AddContactToGroupRequest::GROUP  => 'gruppnamn2'
        ]);

        $this->assertInstanceOf(AddContactToGroupRequest::class, $object);
    }
}