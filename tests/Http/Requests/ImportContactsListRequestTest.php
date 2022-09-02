<?php

namespace Macure\JojkaSDK\Tests\Http\Requests;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\ImportContactsListRequest;

/**
 * Import contact list request test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ImportContactsListRequestTest extends TestCase
{
    /**
     * Test should throw exception for missing options
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingOptions()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('Both contacts_list, contacts_list_url are null or both are provided');

        new ImportContactsListRequest([]);
    }

    /**
     * Test should throw exception for missing contacts list options
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingContactsListOptions()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required options "groups", "name" are missing.');
        
        new ImportContactsListRequest([
            ImportContactsListRequest::CONTACTS_LIST => [
                [
                    'msisdn' => '46709771337'
                ]
            ]
        ]);
    }

    /**
     * Test should throw exception for missing contacts list groups option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingContactsListGroupsOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "groups" is missing.');
        
        new ImportContactsListRequest([
            ImportContactsListRequest::CONTACTS_LIST => [
                [
                    'msisdn' => '46709771337',
                    'name'   => 'Lilleman'
                ]
            ]
        ]);
    }

    /**
     * Test should throw exception for missing contacts list name option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingContactsListNameOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "name" is missing.');
        
        new ImportContactsListRequest([
            ImportContactsListRequest::CONTACTS_LIST => [
                [
                    'msisdn' => '46709771337',
                    'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
                ]
            ]
        ]);
    }

    /**
     * Test should throw exception for missing contacts list msisdn option
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingContactsListMsisdnOption()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "msisdn" is missing.');
        
        new ImportContactsListRequest([
            ImportContactsListRequest::CONTACTS_LIST => [
                [
                    'name'   => 'Lilleman',
                    'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
                ]
            ]
        ]);
    }

    /**
     * Test should initialize object
     *
     * @return void
     */
    public function testShouldInitializeObject()
    {
        $object = new ImportContactsListRequest([
            ImportContactsListRequest::CONTACTS_LIST => [
                [
                    'msisdn' => '46709771337',
                    'name'   => 'Lilleman',
                    'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
                ]
            ]
        ]);

        $this->assertInstanceOf(ImportContactsListRequest::class, $object);
    }
}
