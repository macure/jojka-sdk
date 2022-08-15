<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\RemoveContactRequest;
use Macure\JojkaSDK\Http\Requests\RemoveFromBlocklistRequest;

/**
 * Remove from blocklist request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class RemoveFromBlocklistRequestTest extends TestCase
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

        new RemoveFromBlocklistRequest([]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new RemoveFromBlocklistRequest([
            RemoveFromBlocklistRequest::MSISDN => '46709771337',
        ]);

        $this->assertInstanceOf(RemoveFromBlocklistRequest::class, $object);
    }
}