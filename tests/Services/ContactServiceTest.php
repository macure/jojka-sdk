<?php

namespace Macure\JojkaSDK\Tests\Services;

use GuzzleHttp\Client;
use Macure\JojkaSDK\Exceptions\InvalidOptionsException;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Tests\Helper;
use Macure\JojkaSDK\Http\Requests\AddContactRequest;
use Macure\JojkaSDK\Http\Requests\InBlocklistRequest;
use Macure\JojkaSDK\Http\Requests\RemoveContactRequest;
use Macure\JojkaSDK\Http\Requests\AddToBlocklistRequest;
use Macure\JojkaSDK\Http\Requests\AddContactToGroupRequest;
use Macure\JojkaSDK\Http\Requests\ExportContactsListRequest;
use Macure\JojkaSDK\Http\Requests\ImportContactsListRequest;
use Macure\JojkaSDK\Http\Requests\GetGroupsFromMsisdnRequest;
use Macure\JojkaSDK\Http\Requests\RemoveFromBlocklistrequest;
use Macure\JojkaSDK\Http\Requests\RemoveContactFromGroupRequest;

/**
 * Contact Service test class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactServiceTest extends TestCase
{
    /**
     * Test should throw exceptions for invalid arguments
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidArguments()
    {
        $this->expectException(InvalidOptionsException::class);

        $data = [
            ExportContactsListRequest::MAX    => 10001,
            ExportContactsListRequest::OFFSET => 0,
        ];
        
        new ExportContactsListRequest($data);        
   }
   
    /**
     * Test Should add Contact
     *
     * @return void
     */
    public function testShouldAddContact()
    {
        $body = '{"msisdn": "46709771337"}';

        $data = [
            AddContactRequest::MSISDN => '46709771337',
            AddContactRequest::NAME   => 'Lilleman',
            AddContactRequest::GROUP  => 'Utvecklare;Jojka personal'
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new AddContactRequest($data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test Should remove contact
     *
     * @return void
     */
    public function testShouldRemoveContact()
    {
        $body = '{"successes": "done"}';

        $data = [
            RemoveContactRequest::MSISDN => '46709771337'
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new RemoveContactRequest($data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should add contact to group 
     *
     * @return void
     */
    public function testShouldAddContactToGroup()
    {
        $body = '{"msisdn": "46709771337","group": "gruppnamn2"}';
        
        $data = [
            AddContactToGroupRequest::MSISDN => '46709771337',
            AddContactToGroupRequest::GROUP  => 'gruppnamn2'
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new AddContactToGroupRequest($data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should remove contact from group
     *
     * @return void
     */
    public function testShouldRemoveContactFromGroup()
    {
        $body = '{"msisdn": "46709771337","group": "Utvecklare"}';

        $data = [
            RemoveContactFromGroupRequest::MSISDN => '46709771337',
            RemoveContactFromGroupRequest::GROUP  => 'Utvecklare'
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new RemoveContactFromGroupRequest($data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should import contacts list
     *
     * @return void
     */
    public function testShouldImportContactsList()
    {
        $body = '{"successes": "done"}';

        $data = [
            ImportContactsListRequest::CONTACTS_LIST => [
                'msisdn' => '46709771337',
                'name'   => 'Lilleman',
                'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
            ]
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new ImportContactsListRequest($data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }


    /**
     * Test should export contacts list 
     *
     * @return void
     */
    public function testShouldExportContactsList()
    {
        $body = '{
                    "export": [
                        {
                            "msisdn": "46709771337",
                            "name": "Lilleman",
                            "groups": [
                                "Utvecklare",
                                "Jojka personal",
                                "gruppnamn2"
                            ]
                        },
                        {
                            "msisdn": "46709966666",
                            "name": "Rutger Lindquist",
                            "groups": [
                            "VD"
                            ]
                        }
                    ]
                }';
            
        $data = [
            ExportContactsListRequest::MAX    => 100,
            ExportContactsListRequest::OFFSET => 0
        ];
            
        $client   = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new ExportContactsListRequest($data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should get groups from msisdn
     *
     * @return void
     */
    public function testShouldGetGroupsFromMsisdn()
    {
        $body = '{"groups": [1,2,3,4]}';
    
        $data = [
            GetGroupsFromMsisdnRequest::MSISDN => '46709771337'
        ];
            
        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new GetGroupsFromMsisdnRequest($data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should remove from blocklist
     *
     * @return void
     */
    public function testShouldRemoveFromBlocklist()
    {
        $body = '{"successes": "done"}';

        $data = [
            RemoveFromBlocklistrequest::MSISDN => '46709771337'
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new RemoveFromBlocklistrequest($data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should add to blocklist
     *
     * @return void
     */
    public function testShouldAddToBlocklist()
    {
        $body = '{"successes": "done"}';

        $data = [
            AddToBlocklistRequest::MSISDN => '46709771337'
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new AddToBlocklistRequest($data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should be in blocklist
     *
     * @return void
     */
    public function testShouldBeInBlocklist()
    {
        $body = '{"in_blocklist": true}';

        $data = [
            InBlocklistRequest::MSISDN => '46709771337'
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new InBlocklistRequest($data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }
}
