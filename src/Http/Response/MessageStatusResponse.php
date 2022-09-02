<?php

namespace Macure\JojkaSDK\Http\Response;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\StreamInterface;

/**
 * Message Status Response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageStatusResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = 'string';

     /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function deserialize($format = self::JSON)
    {
        return parent::deserialize($format);
    }

    /**
     * {@inheritDoc}
     */
    public function getBody(): StreamInterface
    {
        $array = json_decode(parent::getBody(), true);

        if (is_array($array)) {
            $array = reset($array);
        }

        return Utils::streamFor($array ? (string) json_encode($array) : "");
    }
}
