<?php 

namespace Macure\JojkaSDK\Service;

use GuzzleHttp\Client;

/**
 * Abstract Service class
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
abstract class AbstractService
{
    /**
     * Client
     *
     * @var Client
     */
    protected $client;

    /**
     * Config
     *
     * @var array<string,mixed>
     */
    protected $config;

    /**
     * Constructor
     * 
     * @param array<string,mixed> $config 
     * @param Client              $client
     */
    public function __construct(array $config, $client = null)
    {
        $this->config = array_replace_recursive([
            'API_key' => null
        ], $config);

        $this->client = $client ?: new \GuzzleHttp\Client([
            'base_uri' => 'https://www.jojka.nu'
        ]);
    }

    /**
     * Prepare Defaults
     *
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed> $data
     */
    protected function prepareDefaults($data)
    {
        return array_merge(['API_key' => $this->config['API_key']], $data);
    }
}