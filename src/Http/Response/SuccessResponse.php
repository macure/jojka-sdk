<?php

namespace Macure\JojkaSDK\Http\Response;

use Macure\JojkaSDK\Models\Success;

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
    protected $deserializeType = Success::class;

    /**
     * {@inheritDoc}
     *
     * @return Success
     */
    public function deserialize($format = self::JSON)
    {
        $object = parent::deserialize($format);

        if (! $object instanceof Success) {
            $this->throwDeserializationException($format);
        }

        return $object;
    }
}
