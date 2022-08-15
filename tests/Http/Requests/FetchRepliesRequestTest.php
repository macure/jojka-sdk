<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Http\Requests\FetchRepliesRequest;
use Macure\JojkaSDK\Exceptions\InvalidOptionsException;

/**
 * Fetch replies request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class FetchRepliesRequestTest extends TestCase
{
     /**
     * Test should should initialize object with zero options
     *
     * @return void
     */
    public function testShouldInitializeObjectWithZeroOptions()
    {
        $object = new FetchRepliesRequest([]);

        $this->assertInstanceOf(FetchRepliesRequest::class, $object);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new FetchRepliesRequest([
            FetchRepliesRequest::FROM_MSISDN => '46709771337',
            FetchRepliesRequest::SINCE_TIME  => '2016-05-31 13:00:06'
        ]);

        $this->assertInstanceOf(FetchRepliesRequest::class, $object);
    }
    
    /**
     * Test should throw exception for invalid scheduled option
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidScheduledOption()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('Optional parameter since_time must be given in the format "Y-m-d H:i:s"');

        new FetchRepliesRequest([
            FetchRepliesRequest::SINCE_TIME => '2016/05/31 12:18:52',
        ]);
    }
}