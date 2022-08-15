<?php

namespace Macure\JojkaSDK\Services;

use Macure\JojkaSDK\Http\Requests\SendRequest;
use Macure\JojkaSDK\Http\Response\ArrayResponse;
use Macure\JojkaSDK\Http\Response\MessageResponse;
use Macure\JojkaSDK\Http\Response\ReplyListResponse;
use Macure\JojkaSDK\Http\Requests\FetchRepliesRequest;
use Macure\JojkaSDK\Http\Response\MessageStatusResponse;
use Macure\JojkaSDK\Http\Requests\GetMessageStatusRequest;
use Macure\JojkaSDK\Http\Requests\GetMessageIdsByCampaignIdRequest;

/**
 * Message Service class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageService extends AbstractService
{
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
     * @return ReplyListResponse
     * 
     * @see \Macure\JojkaSDK\Http\Requests\FetchRepliesRequest for a list of available options.
     */
    public function fetchReplies(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new FetchRepliesRequest($data));

        return new ReplyListResponse($response->getStatusCode(), $response->getHeaders(), $response->getBody());
    }

    /**
     * Fetch all SMS IDs for a particular campaign ID.
     *
     * Here's an example
     * 
     *      $api->getMsgIdsByCampaignId([
     *          'campaign_id' => 287359,
     *      ]);
     * 
     * @param array<string,int> $data
     * 
     * @return ArrayResponse
     * 
     * @see \Macure\JojkaSDK\Http\Requests\GetMessageIdsByCampaignIdRequest for a list of available options.
     */
    public function getMessageIdsByCampaignId(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new GetMessageIdsByCampaignIdRequest($data));

        return new ArrayResponse($response->getStatusCode(), $response->getHeaders(), $response->getBody());
    }

    /**
     * Fetch delivery status of an SMS. 
     *
     * Here's an example
     * 
     *      $api->getMessageStatus([
     *          'msg_id' => 116690255,
     *      ]);
     * 
     * @param array<string,int> $data
     * 
     * @return MessageStatusResponse
     * 
     * @see \Macure\JojkaSDK\Http\Requests\GetMessageStatusRequest for a list of available options.
     */
    public function getMessageStatus(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new GetMessageStatusRequest($data));

        return new MessageStatusResponse($response->getStatusCode(), $response->getHeaders(), $response->getBody());
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
     * @return MessageResponse
     * 
     * @see \Macure\JojkaSDK\Http\Requests\SendRequest for a list of available options.
     */
    public function send(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new SendRequest($data));

        return new MessageResponse($response->getStatusCode(), $response->getHeaders(), $response->getBody());
    }
}