<?php

namespace Macure\JojkaSDK\Http\Requests;

use GuzzleHttp\Psr7\Request as BaseRequest;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Macure\JojkaSDK\Exceptions\InvalidOptionsException;
use Macure\JojkaSDK\Exceptions\MissingOptionsException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException as ResolverInvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException as ResolverMissingOptionsException;

/**
 * Request
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class Request extends BaseRequest
{
    /**
     * Main URI
     */
    public const URI = '/websms/api';

    /**
     * The parameter API_key ​ must be sent in all calls.
     * 
     * Required.
     */
    public const API_KEY = 'API_key';

    /**
     * Constructor
     *
     * @param array<string,mixed> $data
     * 
     */
    public function __construct($data)
    {
        $resolver = new OptionsResolver();
        $data     = array_filter($data);

        $this->configure($resolver);
        
        try {
            $data = $resolver->resolve($data);
        }
        catch (ResolverInvalidOptionsException $e) {
            throw new InvalidOptionsException($e->getMessage());
        }
        catch (ResolverMissingOptionsException $e) {
            throw new MissingOptionsException($e->getMessage());
        }

        parent::__construct('POST', static::URI, [], http_build_query($data));
    }

    /**
     * Configure options
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    protected function configure(OptionsResolver $resolver) 
    {
        $resolver->setDefined(Request::API_KEY);
    }
}