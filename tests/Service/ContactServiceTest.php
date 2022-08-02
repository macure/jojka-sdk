<?php

namespace Macure\JojkaSDK\Tests\Service;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Tests\Helper;
use Macure\JojkaSDK\Http\Requests\Request;
use Macure\JojkaSDK\Service\ContactService;
use Macure\JojkaSDK\Http\Options\AddContactOptions;
use Macure\JojkaSDK\Http\Options\RemoveContactOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Macure\JojkaSDK\Http\Options\AddContactToGroupOptions;
use Macure\JojkaSDK\Http\Options\AddToBlocklistOptions;
use Macure\JojkaSDK\Http\Options\ExportContactsListOptions;
use Macure\JojkaSDK\Http\Options\ImportContactsListOptions;
use Macure\JojkaSDK\Http\Options\GetGroupsFromMsisdnOptions;
use Macure\JojkaSDK\Http\Options\InBlocklistOptions;
use Macure\JojkaSDK\Http\Options\RemoveFromBlocklistOptions;
use Macure\JojkaSDK\Http\Options\RemoveContactFromGroupOptions;

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

        $data = [
            AddContactOptions::MSISDN => '46709771337',
            AddContactOptions::NAME   => 'Lilleman',
            AddContactOptions::GROUP  => 'Utvecklare;Jojka personal'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        AddContactOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::ADD_CONTACT_URI, $data)); 

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
            AddContactOptions::MSISDN => '46709771337'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        RemoveContactOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::RM_CONTACT_URI, $data)); 

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
            AddContactOptions::MSISDN => '46709771337',
            AddContactOptions::GROUP  => 'gruppnamn2'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        AddContactToGroupOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::ADD_CONTACT_TO_GROUP_URI, $data)); 

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
            RemoveContactFromGroupOptions::MSISDN => '46709771337',
            RemoveContactFromGroupOptions::GROUP  => 'Utvecklare'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        RemoveContactFromGroupOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::RM_CONTACT_FROM_GROUP_URI, $data));

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
            ImportContactsListOptions::CONTACTS_LIST => [
                'msisdn' => '46709771337',
                'name'   => 'Lilleman',
                'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
            ]
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        ImportContactsListOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::IMPORT_CONTACTS_LIST_URI, $data));

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
            ExportContactsListOptions::MAX    => 100,
            ExportContactsListOptions::OFFSET => 0
        ];
            
        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        ExportContactsListOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::EXPORT_CONTACTS_LIST_URI, $data)); 

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
            GetGroupsFromMsisdnOptions::MSISDN => '46709771337'
        ];
            
        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        GetGroupsFromMsisdnOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::GET_GROUPS_FROM_MSISDN_URI, $data)); 

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
            RemoveFromBlocklistOptions::MSISDN => '46709771337'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        RemoveFromBlocklistOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::RM_FROM_BLOCKLIST_URI, $data)); 

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
            AddToBlocklistOptions::MSISDN => '46709771337'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        AddToBlocklistOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::ADD_TO_BLOCKLIST_URI, $data)); 

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
            InBlocklistOptions::MSISDN => '46709771337'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        InBlocklistOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(ContactService::IN_BLOCKLIST_URI, $data)); 

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }
}
