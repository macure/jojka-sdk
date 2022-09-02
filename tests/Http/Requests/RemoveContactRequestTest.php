<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\RemoveContactRequest;

/**
 * Remove contact request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class RemoveContactRequestTest extends TestCase
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

        new RemoveContactRequest([]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new RemoveContactRequest([
            RemoveContactRequest::MSISDN => '46709771337',
        ]);

        $this->assertInstanceOf(RemoveContactRequest::class, $object);
    }
}