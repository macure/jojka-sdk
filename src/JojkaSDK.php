<?php
namespace Macure\JojkaSDK;

use GuzzleHttp\Client;
use Macure\JojkaSDK\Services\ContactService;
use Macure\JojkaSDK\Services\MessageService;
use Macure\JojkaSDK\Services\CampaignService;

/**
 * JojkaSDK class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
final class JojkaSDK 
{
    /**
     * Contact Service
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
     * Message Service
     *
     * @var MessageService
     */
    public $message;

    /**
     * Constructor
     * 
     * Here's an example
     * 
     *      $api = new \Macure\JojkaSDK\JojkaSDK([
     *          'API_key' => 'foobar'
     *      ]);
     * 
     * @param array<string,mixed> $config 
     * @param Client              $client
     */
    public function __construct(array $config = [], $client = null)
    {
        $this->contact  = new ContactService($config, $client);
        $this->campaign = new CampaignService($config, $client);
        $this->message  = new MessageService($config, $client);
    }
}