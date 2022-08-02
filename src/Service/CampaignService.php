<?php

namespace Macure\JojkaSDK\Service;

use Macure\JojkaSDK\Http\Requests\AddCampaignRequest;
use Macure\JojkaSDK\Http\Requests\GetCampaignRecipientsStatusRequest;

/**
 * Campaign Service class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignService extends AbstractService
{
    /**
     * {@inheritDoc}
     * 
     * Here's an example
     * 
     *      $api = new \Macure\JojkaSDK\Service\CampaignService([
     *          'API_key' => 'foobar'
     *      ]);
     */
    public function __construct(array $config, $client = null)
    {
        parent::__construct($config, $client);
    }

    /**
     * Send an SMS to several recipients, and make the statistics for this available via both Jojka's GUI and API.
     * 
     * Here's an example
     * 
     *      $api->addCampaign([
     *          'to_msisdn' => '46709771337;46709966666',
     *          'msg'       => 'hello',
     *          'scheduled' => '2016-05-31 12:18:52',
     *          'name'      => 'test campaign'
     *      ]);
     *
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\AddCampaignRequest for a list of available options.
     */
    public function addCampaign(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new AddCampaignRequest($data));

        return json_decode($response->getBody(), true);
    }

    /**
     * Get campaign recipients status
     *
     * Here's an example
     * 
     *      $api->getCampaignRecipientsStatus([
     *          'campaign_id' => 287359,
     *      ]);
     * 
     * @param array<string,mixed> $data
     * 
     * @return array<string,mixed>
     * 
     * @see \Macure\JojkaSDK\Http\Requests\GetCampaignRecipientsStatusRequest for a list of available options.
     */
    public function getCampaignRecipientsStatus(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->client->sendRequest(new GetCampaignRecipientsStatusRequest($data));

        return json_decode($response->getBody(), true);
    }
}
