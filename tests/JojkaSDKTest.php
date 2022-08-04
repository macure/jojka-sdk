<?php

namespace Macure\JojkaSDK\Tests;

use Macure\JojkaSDK\JojkaSDK;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Services\ContactService;
use Macure\JojkaSDK\Services\MessageService;
use Macure\JojkaSDK\Services\CampaignService;
use Macure\JojkaSDK\Exceptions\MissingConfigurationException;

/**
 * Jojka SDK Test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class JojkaSDKTest extends TestCase
{
    /**
     * Test should throw missing configuration exception
     *
     * @return void
     */
    public function testShouldThrowExceptionForMissingArguments()
    {
        $this->expectException(MissingConfigurationException::class);

        $sdk = new JojkaSDK();
    }

    /**
     * Test SDK services
     *
     * @return void
     */
    public function testSdkServices()
    {
        $sdk = new JojkaSDK(['API_key' => 'foobar']);

        $this->assertInstanceOf(ContactService::class,  $sdk->contact);
        $this->assertInstanceOf(MessageService::class,  $sdk->message);
        $this->assertInstanceOf(CampaignService::class, $sdk->campaign);
    }
}
