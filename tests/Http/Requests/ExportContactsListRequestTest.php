<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\InvalidOptionsException;
use Macure\JojkaSDK\Http\Requests\ExportContactsListRequest;

/**
 * Export contact list request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ExportContactsListRequestTest extends TestCase
{
    /**
     * Test should throw exception for invalid offset option
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidOffsetOption()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('Optional parameter offset must be higher than, or 0');

        new ExportContactsListRequest([
            ExportContactsListRequest::OFFSET => -1
        ]);
    }

    /**
     * Test should throw exception for invalid max option
     *
     * @return void
     */
    public function testShouldThrowExceptionForIvalidMaxOption()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('Optional parameter max must be between 0 and 10000');

        new ExportContactsListRequest([
            ExportContactsListRequest::MAX => 10001
        ]);
    }

    /**
     * Test should should initialize object with zero options
     *
     * @return void
     */
    public function testShouldInitializeObjectWithZeroOptions()
    {
        $object = new ExportContactsListRequest([]);

        $this->assertInstanceOf(ExportContactsListRequest::class, $object);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new ExportContactsListRequest([
            ExportContactsListRequest::MAX    => 100,
            ExportContactsListRequest::OFFSET => 0
        ]);

        $this->assertInstanceOf(ExportContactsListRequest::class, $object);
    }
}