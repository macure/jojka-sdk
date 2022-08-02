<?php

namespace Macure\JojkaSDK\Tests\Service;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Tests\Helper;
use Macure\JojkaSDK\Http\Requests\Request;
use Macure\JojkaSDK\Service\CampaignService;
use Macure\JojkaSDK\Http\Options\AddCampaignOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Macure\JojkaSDK\Http\Options\GetCampaignRecipientsStatusOptions;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

/**
 * Campaign Service test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignServiceTest extends TestCase
{
    /**
     * Test should throw exceptions for invalid arguments
     *
     * @return void
     */
    public function testShouldThrowExceptionForInvalidArguments()
    {
        $this->expectException(MissingOptionsException::class);

        $data = [
            AddCampaignOptions::MSG       => 'hello',
            AddCampaignOptions::SCHEDULED => '2016-05-31 12:18:52',
            AddCampaignOptions::NAME      => 'test campaign'
        ];

        $resolver = new OptionsResolver();
        
        AddCampaignOptions::configure($resolver);
        
        $resolver->resolve($data);
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
            AddCampaignOptions::TO_MSISDN => '46709771337;46709966666',
            AddCampaignOptions::MSG       => 'hello',
            AddCampaignOptions::SCHEDULED => '2016-05-31 12:18:52',
            AddCampaignOptions::NAME      => 'test campaign'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);
        
        AddCampaignOptions::configure($resolver);
        
        $data = $resolver->resolve($data);
        
        $response = $client->sendRequest(new Request(CampaignService::ADD_CAMPAIGN_URI, $data));

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
            GetCampaignRecipientsStatusOptions::CAMPAIGN_ID  => 287359
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        GetCampaignRecipientsStatusOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(CampaignService::GET_CAMPAIGN_RECIPIENTS_STATUS_URI, $data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }
}
