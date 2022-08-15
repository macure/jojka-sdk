<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use Macure\JojkaSDK\Exceptions\InvalidOptionsException;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Http\Requests\SendRequest;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;

/**
 * Send request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class SendRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing options
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingOptions()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required options "msg", "to" are missing.');

        new SendRequest([]);
    }

    /**
     * Test should throw exception for missing to option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingToOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "to" is missing');

        new SendRequest([
            SendRequest::MSG => 'hello world'
        ]);
    }

    /**
     * Test should throw exception for missing message option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingMessageOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "msg" is missing');

        new SendRequest([
            SendRequest::TO  => '46709771337',
        ]);
    }

    /**
     * Test should throw exception for invalid from option
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidFromOption()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('Optional parameter from is restricted to a-z, A-Z, 0-9 and separators such as - and _. Max 11 characters');

        new SendRequest([
            SendRequest::TO   => '46709771337',
            SendRequest::MSG  => 'hello world',
            SendRequest::FROM => 'Name Surname'
        ]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new SendRequest([
            SendRequest::TO   => '46709771337',
            SendRequest::MSG  => 'hello world',
            SendRequest::FROM => 'NameSurname'
        ]);

        $this->assertInstanceOf(SendRequest::class, $object);
    }
}