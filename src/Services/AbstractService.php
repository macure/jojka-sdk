<?php 

namespace Macure\JojkaSDK\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\BadResponseException;
use Macure\JojkaSDK\Exceptions\ErrorResponseException;
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
            throw new MissingConfigurationException('The required option "API_key" is missing', $e->getCode(), $e->getPrevious());
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

    /**
     * Send an HTTP request.
     *
     * @param RequestInterface    $request 
     * @param array<string,mixed> $options Request options to apply to the given
     *                       request and to the transfer. See \GuzzleHttp\RequestOptions.
     *
     * @return ResponseInterface
     * 
     * @throws ErrorResponseException
     */
    protected function sendRequest(RequestInterface $request, $options=[])
    {
        try {
            $response = $this->client->send($request, $options);
        }
        catch (BadResponseException $e) {
            throw new ErrorResponseException($e->getMessage(), $e->getRequest(), $e->getResponse(), $e->getPrevious());
        }

        $data = json_decode($response->getBody()->getContents(), true);

        if ($data['error'] ?? false) {
            throw new ErrorResponseException(current($data['error']), $request, new Response(400, [], (string) json_encode($data)));
        }

        return $response;
    }
}