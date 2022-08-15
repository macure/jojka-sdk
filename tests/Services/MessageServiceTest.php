<?php

namespace Macure\JojkaSDK\Tests\Services;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Tests\Helper;
use Macure\JojkaSDK\Services\MessageService;
use Macure\JojkaSDK\Http\Requests\SendRequest;
use Macure\JojkaSDK\Http\Response\ArrayResponse;
use Macure\JojkaSDK\Http\Response\MessageResponse;
use Macure\JojkaSDK\Http\Response\ReplyListResponse;
use Macure\JojkaSDK\Http\Requests\FetchRepliesRequest;
use Macure\JojkaSDK\Exceptions\InvalidOptionsException;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Macure\JojkaSDK\Http\Response\MessageStatusResponse;
use Macure\JojkaSDK\Http\Requests\GetMessageStatusRequest;
use Macure\JojkaSDK\Http\Requests\GetMessageIdsByCampaignIdRequest;

/**
 * Message Service test class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageServiceTest extends TestCase
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
            SendRequest::MSG  => 'hello'
        ];
        
        new SendRequest($data);        
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
            SendRequest::TO   => '46709771337',
            SendRequest::FROM => 'jojka!',
            SendRequest::MSG  => 'hello'
        ];
        
        new SendRequest($data);        
   }
   
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

        $messageService = $this->createMessageService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $messageService->fetchReplies([
            FetchRepliesRequest::FROM_MSISDN => '46709771337',
            FetchRepliesRequest::SINCE_TIME  => '2016-05-31 13:00:06'
        ]);

        $this->assertInstanceOf(ReplyListResponse::class, $response);
    }

    /**
     * Test should get mesages ids by campaignId
     *
     * @return void
     */
    public function testShouldGetMessageIdsByCampaignId()
    {
        $body = '["116690255","116690256"]';

        $messageService = $this->createMessageService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $messageService->getMessageIdsByCampaignId([
            GetMessageIdsByCampaignIdRequest::CAMPAIGN_ID => 287359
        ]);

        $this->assertInstanceOf(ArrayResponse::class, $response);
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
            GetMessageStatusRequest::MSG_ID => 116690255,
        ];

        $messageService = $this->createMessageService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $messageService->getMessageStatus([
            GetMessageStatusRequest::MSG_ID => 116690255,
        ]);

        $this->assertInstanceOf(MessageStatusResponse::class, $response);
    }

    /**
     * Test should send
     *
     * @return void
     */
    public function testShouldSend()
    {
        $body = '{"message_id": "116690855"}';

        $messageService = $this->createMessageService(
            new Client([
                'handler' => Helper::getMockHandler(200, $body)
            ])
        );

        $response = $messageService->send([
            SendRequest::TO  => '46709771337',
            SendRequest::MSG => 'hello world'
        ]);

        $this->assertInstanceOf(MessageResponse::class, $response);
    }

    /**
     * Create message service
     *
     * @param Client $client
     *
     * @return MessageService
     */
    private function createMessageService(Client $client) 
    {
        return new MessageService(['API_key' => 'foobar'], $client);
    }
}