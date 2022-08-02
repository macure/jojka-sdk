<?php

namespace Macure\JojkaSDK\Service;

use Macure\JojkaSDK\Http\Requests\Request;
use Macure\JojkaSDK\Http\Options\AddContactOptions;
use Macure\JojkaSDK\Http\Options\InBlocklistOptions;
use Macure\JojkaSDK\Http\Options\RemoveContactOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Macure\JojkaSDK\Http\Options\AddToBlocklistOptions;
use Macure\JojkaSDK\Http\Options\AddContactToGroupOptions;
use Macure\JojkaSDK\Http\Options\ExportContactsListOptions;
use Macure\JojkaSDK\Http\Options\ImportContactsListOptions;
use Macure\JojkaSDK\Http\Options\GetGroupsFromMsisdnOptions;
use Macure\JojkaSDK\Http\Options\RemoveFromBlocklistOptions;
use Macure\JojkaSDK\Http\Options\RemoveContactFromGroupOptions;

/**
 * Contact Service class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactService extends AbstractService
{
    public const ADD_CONTACT_URI            = '/add_contact';
    public const RM_CONTACT_URI             = '/rm_contact';
    public const ADD_CONTACT_TO_GROUP_URI   = '/add_contact_to_group';
    public const RM_CONTACT_FROM_GROUP_URI  = '/rm_contact_from_group';
    public const EXPORT_CONTACTS_LIST_URI   = '/export_contacts_list';
    public const IMPORT_CONTACTS_LIST_URI   = '/import_contacts_list';
    public const GET_GROUPS_FROM_MSISDN_URI = '/get_groups_from_msisdn';
    public const RM_FROM_BLOCKLIST_URI      = '/rm_from_blocklist';
    public const ADD_TO_BLOCKLIST_URI       = '/add_to_blocklist';
    public const IN_BLOCKLIST_URI           = '/check_if_in_blocklist';

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
     *          'name'   => 'Lilleman'
     *          'group'  => 'Utvecklare;Jojka personal',
     *      ]);
     *
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed>
     * 
     * @see \Macure\JojkaSDK\Http\Options\AddContactOptions for a list of available options.
     */
    public function addContact(array $data)
    {
        $resolver = new OptionsResolver();
        AddContactOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::ADD_CONTACT_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\RemoveContactOptions for a list of available options.
     */
    public function removeContact(array $data)
    {
        $resolver = new OptionsResolver();
        RemoveContactOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::RM_CONTACT_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\AddContactToGroupOptions for a list of available options.
     */
    public function addContactToGroup(array $data)
    {
        $resolver = new OptionsResolver();
        AddContactToGroupOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::ADD_CONTACT_TO_GROUP_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\RemoveContactFromGroupOptions for a list of available options.
     */
    public function removeContactFromGroup(array $data)
    {
        $resolver = new OptionsResolver();
        RemoveContactFromGroupOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::RM_CONTACT_FROM_GROUP_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\ExportContactsListOptions for a list of available options.
     */
    public function exportContactsList(array $data)
    {
        $resolver = new OptionsResolver();
        ExportContactsListOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::EXPORT_CONTACTS_LIST_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\ImportContactsListOptions for a list of available options.
     */
    public function importContactsList(array $data)
    {
        $resolver = new OptionsResolver();
        ImportContactsListOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::IMPORT_CONTACTS_LIST_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\GetGroupsFromMsisdnOptions for a list of available options.
     */
    public function getGroupsFromMsisdn(array $data)
    {
        $resolver = new OptionsResolver();
        GetGroupsFromMsisdnOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::GET_GROUPS_FROM_MSISDN_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\RemoveFromBlocklistOptions for a list of available options.
     */
    public function removeFromBlocklist(array $data)
    {
        $resolver = new OptionsResolver();
        RemoveFromBlocklistOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::RM_FROM_BLOCKLIST_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\AddToBlocklistOptions for a list of available options.
     */
    public function addToBlocklist(array $data)
    {
        $resolver = new OptionsResolver();
        AddToBlocklistOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::ADD_TO_BLOCKLIST_URI, $this->prepareDefaults($data)));

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
     * @see \Macure\JojkaSDK\Http\Options\InBlocklistOptions for a list of available options.
     */
    public function inBlocklist(array $data)
    {
        $resolver = new OptionsResolver();
        InBlocklistOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::IN_BLOCKLIST_URI, $this->prepareDefaults($data)));

        return json_decode($response->getBody(), true);
    }
}
