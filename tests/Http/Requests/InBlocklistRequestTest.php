<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\AddToBlocklistRequest;
use Macure\JojkaSDK\Http\Requests\InBlocklistRequest;

/**
 * In blocklist request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class InBlocklistRequestTest extends TestCase
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

        new InBlocklistRequest([]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new InBlocklistRequest([
            InBlocklistRequest::MSISDN => '46709771337',
        ]);

        $this->assertInstanceOf(InBlocklistRequest::class, $object);
    }
}