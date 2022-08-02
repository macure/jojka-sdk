<?php

namespace Macure\JojkaSDK\Service;

use Macure\JojkaSDK\Http\Requests\Request;
use Macure\JojkaSDK\Http\Options\SendOptions;
use Macure\JojkaSDK\Http\Options\FetchRepliesOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Macure\JojkaSDK\Http\Options\GetMessageStatusOptions;
use Macure\JojkaSDK\Http\Options\GetMessageIdsByCampaignIdOptions;

/**
 * Message Service class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageService extends AbstractService
{
    public const FETCH_REPLIES_URI              = '/fetch_replies';
    public const GET_MSG_IDS_BY_CAMPAIGN_ID_URI = '/get_msg_ids_by_campaign_id';
    public const GET_MSG_STATUS_URI             = '/get_msg_status';
    public const SEND_URI                       = '/send';

    /**
     * {@inheritDoc}
     * 
     * Here's an example
     * 
     *      $api = new \Macure\JojkaSDK\Service\MessageService([
     *          'API_key' => 'foobar'
     *      ]);
     */
    public function __construct(array $config, $client = null)
    {
        parent::__construct($config, $client);
    }

    /**
     * Fetch list of SMS sent from external units to your Jojka account.
     * 
     * Here's an example
     * 
     *      $api->fetchReplies([
     *          'from_msisdn' => '46709771337',
     *          'since_time'  => '2016-05-31 12:58:05',
     *      ]);
     * 
     * @param array<string,string> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Options\FetchRepliesOptions for a list of available options.
     */
    public function fetchReplies(array $data)
    {
        $resolver = new OptionsResolver();
        FetchRepliesOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::FETCH_REPLIES_URI, $this->prepareDefaults($data)));

        return json_decode($response->getBody(), true);
    }

    /**
     * Fetch all SMS IDs for a particular campaign ID. 6
     *
     * Here's an example
     * 
     *      $api->getMsgIdsByCampaignId([
     *          'campaign_id' => 287359,
     *      ]);
     * 
     * @param array<string,string> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Options\GetMessageIdsByCampaignIdOptions for a list of available options.
     */
    public function getMessageIdsByCampaignId(array $data)
    {
        $resolver = new OptionsResolver();
        GetMessageIdsByCampaignIdOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::GET_MSG_IDS_BY_CAMPAIGN_ID_URI, $this->prepareDefaults($data)));

        return json_decode($response->getBody(), true);
    }

    /**
     * Fetch delivery status of an SMS. 
     *
     * Here's an example
     * 
     *      $api->getMesageStatus([
     *          'msg_id' => 116690255,
     *      ]);
     * 
     * @param array<string,string> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Options\GetMessageStatusOptions for a list of available options.
     */
    public function getMesageStatus(array $data)
    {
        $resolver = new OptionsResolver();
        GetMessageStatusOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::GET_MSG_STATUS_URI, $this->prepareDefaults($data)));

        return json_decode($response->getBody(), true);
    }

    

    /**
     * Send an SMS to a recipient
     *
     * Here's an example
     * 
     *      $api->send([
     *          'to'  => '46709771337',
     *          'msg' => 'hello word'
     *      ]);
     * 
     * @param array<string,mixed> $data
     * 
     * @return array<string,string>
     * 
     * @see \Macure\JojkaSDK\Http\Options\SendOptions for a list of available options.
     */
    public function send(array $data)
    {
        $resolver = new OptionsResolver();
        SendOptions::configure($resolver);

        $data = $resolver->resolve($data);

        $response = $this->client->sendRequest(new Request(self::SEND_URI, $this->prepareDefaults($data)));

        return json_decode($response->getBody(), true);
    }
}