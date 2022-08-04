<?php

namespace Macure\JojkaSDK\Services;

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
 * Contact Service class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactService extends AbstractService
{
    /**
     * {@inheritDoc}
     * 
     * Here's an example
     * 
     *      $api = new \Macure\JojkaSDK\Service\ContactService([
     *          'API_key' => 'foobar'
     *      ]);
     */
    public function __construct(array $config, $client = null)
    {
        parent::__construct($config, $client);
    }

    /**
     * Save a contact in Jojka's system.
     * 
     * Here's an example
     * 
     *      $api->addContact([
     *          'msisdn' => '46709771337',
     *          'name'   => 'Lilleman',
     *          'group'  => 'Utvecklare;Jojka personal',
     *      ]);
     *
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\AddContactRequest for a list of available options.
     */
    public function addContact(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new AddContactRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Remove a contact.
     * 
     * Here's an example
     * 
     *      $api->removeContact([
     *          'msisdn' => '46709771337'
     *      ]);
     *
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\RemoveContactRequest for a list of available options.
     */
    public function removeContact(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new RemoveContactRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Mark a contact as a member of a group. A contact can be a member of no, one or several groups at the same time. 
     * Group membership is used to easily define recipients of a campaign without having to list all the numbers.
     * 
     * Here's an example
     * 
     *      $api->addContactToGroup([
     *          'msisdn' => '46709771337',
     *          'group'  => 'gruppnamn2',
     *      ]);
     * 
     * @param array<string,string> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\AddContactToGroupRequest for a list of available options.
     */
    public function addContactToGroup(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new AddContactToGroupRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Unmark a contact as a member of a group
     *
     * Here's an example
     * 
     *      $api->removeContactFromGroup([
     *          'msisdn' => '46709771337',
     *          'group'  => 'Utvecklare'
     *      ]);
     * 
     * @param array<string,mixed> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\RemoveContactFromGroupRequest for a list of available options.
     */
    public function removeContactFromGroup(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new RemoveContactFromGroupRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Fetch saved contacts from Jojka's system.
     * 
     * Here's an example
     * 
     *      $api->exportContactsList([
     *          'max'    => 100,
     *          'offset' => 0,
     *      ]);
     * 
     * @param array<string,string> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\ExportContactsListRequest for a list of available options.
     */
    public function exportContactsList(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new ExportContactsListRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Save several contacts in Jojka's system
     *
     * Here's an example
     * 
     *      $api->importContactsList([
     *          'contacts_list' => [
     *              'msisdn' => '46709771337',
     *              'name'   => 'Lilleman',
     *              'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
     *      ]);
     * 
     * @param array<string,mixed> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\ImportContactsListRequest for a list of available options.
     */
    public function importContactsList(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new ImportContactsListRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Get groups from msisdn
     * 
     * Here's an example
     * 
     *      $api->getGroupsFromMsisdn([
     *          'msisdn' => '46709771337'
     *      ]);
     *
     * @param array<string,mixed> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\GetGroupsFromMsisdnRequest for a list of available options.
     */
    public function getGroupsFromMsisdn(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new GetGroupsFromMsisdnRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Remove form blocklist
     *
     * Here's an example
     * 
     *      $api->removeFromBlocklist([
     *          'msisdn' => '46709771337'
     *      ]);
     * 
     * @param array<string,mixed> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\RemoveFromBlocklistrequest for a list of available options.
     */
    public function removeFromBlocklist(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new RemoveFromBlocklistrequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Add to blocklist
     *
     * Here's an example
     * 
     *      $api->addToBlocklist([
     *          'msisdn' => '46709771337'
     *      ]);
     * 
     * @param array<string,mixed> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Request\AddToBlocklistRequest for a list of available options.
     */
    public function addToBlocklist(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new AddToBlocklistRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Is in blocklist
     *
     * Here's an example
     * 
     *      $api->inBlocklist([
     *          'msisdn' => '46709771337'
     *      ]);
     * 
     * @param array<string,mixed> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\InBlocklistRequest for a list of available options.
     */
    public function inBlocklist(array $data)
    {
        $data = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new InBlocklistRequest($data));

        return json_decode($response->getBody(), true);
    }
}