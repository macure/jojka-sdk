<?php

namespace Macure\JojkaSDK\Tests\Services;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Tests\Helper;
use Macure\JojkaSDK\Services\CampaignService;
use Macure\JojkaSDK\Http\Response\SuccessResponse;
use Macure\JojkaSDK\Http\Response\CampaignResponse;
use Macure\JojkaSDK\Http\Requests\AddCampaignRequest;
use Macure\JojkaSDK\Http\Requests\CancelCampaignRequest;
use Macure\JojkaSDK\Http\Response\CampaignRecipientsStatusResponse;
use Macure\JojkaSDK\Http\Requests\GetCampaignRecipientsStatusRequest;

/**
 * Campaign Service test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignServiceTest extends TestCase
{
    /**
     * Test should add campaign
     *
     * @return void
     */
    public function testShouldAddCampaign()
    {
        $body = '{"campaign_id": "287359"}';

        $campaignService = $this->createCampaignService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $campaignService->addCampaign([
            AddCampaignRequest::TO_MSISDN => '46709771337;46709966666',
            AddCampaignRequest::MSG       => 'hello',
            AddCampaignRequest::SCHEDULED => '2016-05-31 12:18:52',
            AddCampaignRequest::NAME      => 'test campaign'
        ]);

        $this->assertInstanceOf(CampaignResponse::class, $response);
    }

    /**
     * Test should cancel campaign
     *
     * @return void
     */
    public function testShouldCancelCampaign()
    {
        $body = '{"successes": "done"}';

        $campaignService = $this->createCampaignService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $campaignService->cancelCampaign([
            CancelCampaignRequest::CAMPAIGN_ID => 287359
        ]);

        $this->assertInstanceOf(SuccessResponse::class, $response);
    }

    /**
     * Test should get campaign recipients status
     *
     * @return void
     */
    public function testShouldGetCampaignRecipientsStatus()
    {
        $body = '[
                    {
                        "receiver":   "467352xxxxx",
                        "message_id": "1900607",
                        "status":     "DELIVERED"
                    },
                    {
                        "receiver":   "4670903xxxxxx",
                        "message_id": "1925062",
                        "status":     "ERROR"
                    },
                    {
                        "receiver":   "4670903xxxxxx",
                        "message_id": "1925062",
                        "status":     "SENT"
                    }
                ]';

        $campaignService = $this->createCampaignService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $campaignService->getCampaignRecipientsStatus([
            GetCampaignRecipientsStatusRequest::CAMPAIGN_ID => 287359
        ]);

        $this->assertInstanceOf(CampaignRecipientsStatusResponse::class, $response);
    }

    /**
     * Create campaign service
     *
     * @param Client $client
     *
     * @return CampaignService
     */
    private function createCampaignService(Client $client) 
    {
        return new CampaignService(['API_key' => 'foobar'], $client);
    }
}