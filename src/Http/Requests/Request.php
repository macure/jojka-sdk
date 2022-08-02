<?php

namespace Macure\JojkaSDK\Http\Requests;

use GuzzleHttp\Psr7\Request as BaseRequest;

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
     * Constructor
     *
     * @param string $uri
     * @param array<string,mixed> $data
     * 
     */
    public function __construct($uri, $data)
    {
        $data = array_filter($data);

        parent::__construct('POST', Request::URI . $uri, [], http_build_query($data));
    }
}