<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Http\Requests\AddContactRequest;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;

/**
 * Add contact request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class AddContactRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing msisdn and name option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingMsisdnAndNameOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required options "msisdn", "name" are missing');

        new AddContactRequest([]);
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

        new AddContactRequest([
            AddContactRequest::NAME => 'Lilleman'
        ]);
    }

    /**
     * Test should throw exception for missing name option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingNameOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "name" is missing');

        new AddContactRequest([
            AddContactRequest::MSISDN => '46709771337'
        ]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new AddContactRequest([
            AddContactRequest::MSISDN => '46709771337',
            AddContactRequest::NAME   => 'Lilleman',
            AddContactRequest::GROUP  => 'Utvecklare;Jojka personal'
        ]);

        $this->assertInstanceOf(AddContactRequest::class, $object);
    }
}