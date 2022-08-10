<?php

namespace Macure\JojkaSDK\Http\Response;

/**
 * Array response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ArrayResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = 'array';
}
