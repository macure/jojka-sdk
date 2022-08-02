<?php

namespace Macure\JojkaSDK\Tests;

use Macure\JojkaSDK\SDK;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Service\ContactService;
use Macure\JojkaSDK\Service\MessageService;
use Macure\JojkaSDK\Service\CampaignService;

/**
 * SDK Test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class SDKTest extends TestCase
{
    /**
     * Test SDK services
     *
     * @return void
     */
    public function testSdkServices()
    {
        $sdk = new SDK(['API_key' => 'foobar']);

        $this->assertInstanceOf(ContactService::class,  $sdk->contact);
        $this->assertInstanceOf(MessageService::class,  $sdk->message);
        $this->assertInstanceOf(CampaignService::class, $sdk->campaign);
    }
}
