<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\GetMessageStatusRequest;

/**
 * Get message status request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class GetMessageStatusRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing message id option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingMessageIdOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "msg_id" is missing');

        new GetMessageStatusRequest([]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new GetMessageStatusRequest([
            GetMessageStatusRequest::MSG_ID => '6223c1c6079e9c21b5901d63',
        ]);

        $this->assertInstanceOf(GetMessageStatusRequest::class, $object);
    }
}
