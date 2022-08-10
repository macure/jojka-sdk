<?php

namespace Macure\JojkaSDK\Http\Response;

use Macure\JojkaSDK\Models\Reply;

/**
 * Reply Respones
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ReplyListResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = 'array<'.Reply::class.'>';

    /**
     * {@inheritDoc}
     *
     * @return Reply[]
     */
    public function deserialize($format = self::JSON)
    {
        $object = parent::deserialize($format);
        
        if (! is_array($object)) {
            $this->throwDeserializationException($format);
        }

        return $object;
    }
}
