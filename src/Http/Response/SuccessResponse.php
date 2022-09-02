<?php

namespace Macure\JojkaSDK\Http\Response;

/**
 * Success Response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class SuccessResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = 'array';

    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function deserialize($format = self::JSON)
    {
        $array = parent::deserialize($format);

        return "done" === ($array['successes'] ?? false);
    }
}
