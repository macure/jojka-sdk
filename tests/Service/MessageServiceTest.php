<?php

namespace Macure\JojkaSDK\Tests\Service;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Tests\Helper;
use Macure\JojkaSDK\Http\Requests\Request;
use Macure\JojkaSDK\Service\MessageService;
use Macure\JojkaSDK\Http\Options\SendOptions;
use Macure\JojkaSDK\Http\Options\FetchRepliesOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Macure\JojkaSDK\Http\Options\GetMessageStatusOptions;
use Macure\JojkaSDK\Http\Options\GetMessageIdsByCampaignIdOptions;

/**
 * Message Service test class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageServiceTest extends TestCase
{
    /**
     * Test should fetch replies
     *
     * @return void
     */
    public function testShouldFetchReplies()
    {
        $body = '[
                    {
                        "inserted": "2016-05-31 13:00:06",
                        "sender": "46709771337",
                        "message": "Sure"
                    },
                    {
                        "inserted": "2016-05-31 13:01:13",
                        "sender": "46709771337",
                        "message": "Bacon"
                    }
                ]';

        $data = [
            FetchRepliesOptions::FROM_MSISDN => '46709771337',
            FetchRepliesOptions::SINCE_TIME  => '2016-05-31 13:00:06'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        FetchRepliesOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(MessageService::FETCH_REPLIES_URI, $data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should get mesages ids by campaignId
     *
     * @return void
     */
    public function testShouldGetMsgIdsByCampaignId()
    {
        $body = '["116690255","116690256"]';

        $data = [
            GetMessageIdsByCampaignIdOptions::CAMPAIGN_ID => 287359,
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        GetMessageIdsByCampaignIdOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(MessageService::GET_MSG_IDS_BY_CAMPAIGN_ID_URI, $data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should get mesage status
     *
     * @return void
     */
    public function testShouldGetMesageStatus()
    {
        $body = '["DELIVERED"]';

        $data = [
            GetMessageStatusOptions::MSG_ID => 116690255,
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        GetMessageStatusOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(MessageService::GET_MSG_STATUS_URI, $data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test should send
     *
     * @return void
     */
    public function testShouldSend()
    {
        $body = '{"message_id": "116690855"}';

        $data = [
            SendOptions::TO  => '46709771337',
            SendOptions::MSG => 'hello world'
        ];

        $resolver = new OptionsResolver();
        $client   = new Client(['handler' => Helper::getMockHandler(200, $body)]);

        SendOptions::configure($resolver);

        $data     = $resolver->resolve($data);
        $response = $client->sendRequest(new Request(MessageService::SEND_URI, $data));

        $this->assertEquals($body, $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }
}