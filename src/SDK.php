<?php
namespace Macure\JojkaSDK;

use GuzzleHttp\Client;
use Macure\JojkaSDK\Service\ContactService;
use Macure\JojkaSDK\Service\MessageService;
use Macure\JojkaSDK\Service\CampaignService;

/**
 * SDK class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
final class SDK 
{
    /**
     * Contact Endpoint
     *
     * @var ContactService
     */
    public $contact;

    /**
     * Campaign Service
     *
     * @var CampaignService
     */
    public $campaign;

    /**
     * Campaign Service
     *
     * @var MessageService
     */
    public $message;

    /**
     * Constructor
     * 
     * Here's an example
     * 
     *      $api = new \Macure\JojkaSDK\SDK([
     *          'API_key' => 'foobar'
     *      ]);
     * 
     * @param array<string,mixed> $config 
     * @param Client              $client
     */
    public function __construct(array $config, $client = null)
    {
        $this->contact  = new ContactService($config, $client);
        $this->campaign = new CampaignService($config, $client);
        $this->message  = new MessageService($config, $client);
    }
}