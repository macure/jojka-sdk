<?php

namespace Macure\JojkaSDK\Http\Response;

/**
 * Boolean Response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class BooleanResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = 'bool';
}
