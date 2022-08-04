<?php

namespace Macure\JojkaSDK\Tests\Services;

use GuzzleHttp\Client;
use Macure\JojkaSDK\Exceptions\InvalidOptionsException;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Tests\Helper;
use Macure\JojkaSDK\Http\Requests\AddCampaignRequest;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Requests\GetCampaignRecipientsStatusRequest;

/**
 * Campaign Service test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignServiceTest extends TestCase
{
    /**
     * Test should throw exceptions for missing arguments
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingArguments()
    {
        $this->expectException(MissingOptionsException::class);

        $data = [
            AddCampaignRequest::MSG       => 'hello',
            AddCampaignRequest::SCHEDULED => '2016-05-31 12:18:52',
            AddCampaignRequest::NAME      => 'test campaign'
        ];
        
        new AddCampaignRequest($data);        
   }

   /**
     * Test should throw exceptions for invalid arguments
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidArguments()
    {
        $this->expectException(InvalidOptionsException::class);

        $data = [
            AddCampaignRequest::TO_MSISDN => '46709771337;46709966666',
            AddCampaignRequest::MSG       => 'hello',
            AddCampaignRequest::SCHEDULED => '2016/05/31 12:18:52',
            AddCampaignRequest::NAME      => 'test campaign'
        ];
        
        new AddCampaignRequest($data);        
   }
    
    /**
     * Test adding campaign
     * 
     * @return void
     */
    public function testShouldAddCampaign()
    {
        $body = '{"campaign_id": "287359"}';
        
        $data = [
            AddCampaignRequest::TO_MSISDN => '46709771337;46709966666',
            AddCampaignRequest::MSG       => 'hello',
            AddCampaignRequest::SCHEDULED => '2016-05-31 12:18:52',
            AddCampaignRequest::NAME      => 'test campaign',
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new AddCampaignRequest($data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
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
                        "receiver":  "467352xxxxx",
                        "message_id":"1900607",
                        "status":    "DELIVERED"
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

        $data = [
            GetCampaignRecipientsStatusRequest::CAMPAIGN_ID  => 287359
        ];

        $client = new Client([
            'handler' => Helper::getMockHandler(200, $body)
        ]);

        $response = $client->sendRequest(new GetCampaignRecipientsStatusRequest($data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }
}
