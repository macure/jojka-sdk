<?php

namespace Macure\JojkaSDK\Services;

use Macure\JojkaSDK\Http\Response\SuccessResponse;
use Macure\JojkaSDK\Http\Response\CampaignResponse;
use Macure\JojkaSDK\Http\Requests\AddCampaignRequest;
use Macure\JojkaSDK\Http\Requests\CancelCampaignRequest;
use Macure\JojkaSDK\Http\Response\CampaignRecipientsStatusResponse;
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
     * @return CampaignResponse
     * 
     * @see \Macure\JojkaSDK\Http\Requests\AddCampaignRequest for a list of available options.
     */
    public function addCampaign(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->sendRequest(new AddCampaignRequest($data));

        return new CampaignResponse($response->getStatusCode(), $response->getHeaders(), $response->getBody());
    }

    /**
     * Cancel a previously scheduled campaign
     *
     * Here's an example
     * 
     *      $api->cancelCampaign([
     *          'campaign_id' => 287359,
     *      ]);
     * 
     * @param array<string,mixed> $data
     * 
     * @return SuccessResponse
     * 
     * @see \Macure\JojkaSDK\Http\Requests\CancelCampaignRequest for a list of available options.
     */
    public function cancelCampaign(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->sendRequest(new CancelCampaignRequest($data));

        return new SuccessResponse($response->getStatusCode(), $response->getHeaders(), $response->getBody());
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
     * @return CampaignRecipientsStatusResponse
     * 
     * @see \Macure\JojkaSDK\Http\Requests\GetCampaignRecipientsStatusRequest for a list of available options.
     */
    public function getCampaignRecipientsStatus(array $data)
    {
        $data     = $this->prepareDefaults($data);
        $response = $this->sendRequest(new GetCampaignRecipientsStatusRequest($data));

        return new CampaignRecipientsStatusResponse($response->getStatusCode(), $response->getHeaders(), $response->getBody());
    }
}
