<?php

namespace Macure\JojkaSDK\Tests\Services;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Tests\Helper;
use Macure\JojkaSDK\Services\ContactService;
use Macure\JojkaSDK\Http\Response\ArrayResponse;
use Macure\JojkaSDK\Http\Response\BooleanResponse;
use Macure\JojkaSDK\Http\Response\ContactResponse;
use Macure\JojkaSDK\Http\Response\SuccessResponse;
use Macure\JojkaSDK\Http\Requests\AddContactRequest;
use Macure\JojkaSDK\Http\Requests\InBlocklistRequest;
use Macure\JojkaSDK\Http\Response\ContactListResponse;
use Macure\JojkaSDK\Http\Requests\RemoveContactRequest;
use Macure\JojkaSDK\Http\Requests\AddToBlocklistRequest;
use Macure\JojkaSDK\Http\Requests\AddContactToGroupRequest;
use Macure\JojkaSDK\Http\Requests\ExportContactsListRequest;
use Macure\JojkaSDK\Http\Requests\ImportContactsListRequest;
use Macure\JojkaSDK\Http\Requests\GetGroupsFromMsisdnRequest;
use Macure\JojkaSDK\Http\Requests\RemoveFromBlocklistRequest;
use Macure\JojkaSDK\Http\Requests\RemoveContactFromGroupRequest;

/**
 * Contact Service test class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactServiceTest extends TestCase
{
    /**
     * Test Should add Contact
     *
     * @return void
     */
    public function testShouldAddContact()
    {
        $body = '{"msisdn": "46709771337"}';

        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->addContact([
            AddContactRequest::MSISDN => '46709771337',
            AddContactRequest::NAME   => 'Lilleman',
            AddContactRequest::GROUP  => 'Utvecklare;Jojka personal'
        ]);

        $this->assertInstanceOf(ContactResponse::class, $response);
    }

    /**
     * Test Should remove contact
     *
     * @return void
     */
    public function testShouldRemoveContact()
    {
        $body = '{"successes": "done"}';

        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->removeContact([
            RemoveContactRequest::MSISDN => '46709771337'
        ]);

        $this->assertInstanceOf(SuccessResponse::class, $response);
    }

    /**
     * Test should add contact to group 
     *
     * @return void
     */
    public function testShouldAddContactToGroup()
    {
        $body = '{"msisdn": "46709771337","group": "gruppnamn2"}';

        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->addContactToGroup([
            AddContactToGroupRequest::MSISDN => '46709771337',
            AddContactToGroupRequest::GROUP  => 'gruppnamn2'
        ]);

        $this->assertInstanceOf(ContactResponse::class, $response);
    }

    /**
     * Test should remove contact from group
     *
     * @return void
     */
    public function testShouldRemoveContactFromGroup()
    {
        $body = '{"msisdn": "46709771337","group": "Utvecklare"}';

        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->removeContactFromGroup([
            RemoveContactFromGroupRequest::MSISDN => '46709771337',
            RemoveContactFromGroupRequest::GROUP  => 'Utvecklare'
        ]);

        $this->assertInstanceOf(ContactResponse::class, $response);
    }

    /**
     * Test should import contacts list
     *
     * @return void
     */
    public function testShouldImportContactsList()
    {
        $body = '{"successes": "done"}';

        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->importContactsList([
            ImportContactsListRequest::CONTACTS_LIST => [
                [
                    'msisdn' => '46709771337',
                    'name'   => 'Lilleman',
                    'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
                ]
            ]
        ]);

        $this->assertInstanceOf(SuccessResponse::class, $response);
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
            
        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->exportContactsList([
            ExportContactsListRequest::MAX    => 100,
            ExportContactsListRequest::OFFSET => 0
        ]);

        $this->assertInstanceOf(ContactListResponse::class, $response);
    }

    /**
     * Test should get groups from msisdn
     *
     * @return void
     */
    public function testShouldGetGroupsFromMsisdn()
    {
        $body = '{"groups": [1,2,3,4]}';
            
        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->getGroupsFromMsisdn([
            GetGroupsFromMsisdnRequest::MSISDN => '46709771337'
        ]);

        $this->assertInstanceOf(ArrayResponse::class, $response);
    }

    /**
     * Test should remove from blocklist
     *
     * @return void
     */
    public function testShouldRemoveFromBlocklist()
    {
        $body = '{"successes": "done"}';

        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->removeFromBlocklist([
            RemoveFromBlocklistRequest::MSISDN => '46709771337'
        ]);

        $this->assertInstanceOf(SuccessResponse::class, $response);
    }

    /**
     * Test should add to blocklist
     *
     * @return void
     */
    public function testShouldAddToBlocklist()
    {
        $body = '{"successes": "done"}';

        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->addToBlocklist([
            AddToBlocklistRequest::MSISDN => '46709771337'
        ]);

        $this->assertInstanceOf(SuccessResponse::class, $response);
    }

    /**
     * Test should be in blocklist
     *
     * @return void
     */
    public function testShouldBeInBlocklist()
    {
        $body = '{"in_blocklist": true}';

        $contactService = $this->createContactService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $contactService->inBlocklist([
            InBlocklistRequest::MSISDN => '46709771337'
        ]);

        $this->assertInstanceOf(BooleanResponse::class, $response);
    }
    
    /**
     * Create contact service
     *
     * @param Client $client
     *
     * @return ContactService
     */
    private function createContactService(Client $client) 
    {
        return new ContactService(['API_key' => 'foobar'], $client);
    }
}