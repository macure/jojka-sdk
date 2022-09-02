<?php

namespace Macure\JojkaSDK\Http\Response;

use Macure\JojkaSDK\Models\Message;

/**
 * Message Response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = Message::class;

    /**
     * {@inheritDoc}
     *
     * @return Message
     */
    public function deserialize($format = self::JSON)
    {
        $object = parent::deserialize($format);

        if (! $object instanceof Message) {
            $this->throwDeserializationException($format);
        }

        return $object;
    }
}
