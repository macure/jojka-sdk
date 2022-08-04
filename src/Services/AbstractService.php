<?php 

namespace Macure\JojkaSDK\Services;

use Exception;
use GuzzleHttp\Client;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Macure\JojkaSDK\Exceptions\MissingConfigurationException;

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
    public function __construct(array $config = [], $client = null)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired('API_key');

        try {
            $this->config = $resolver->resolve($config);
        }
        catch (Exception $e) {
            throw new MissingConfigurationException('The required option "API_key" is missing');
        }

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