<?php

namespace Macure\JojkaSDK\Http\Response;

use GuzzleHttp\Psr7\Utils;
use Macure\JojkaSDK\Models\Contact;
use Psr\Http\Message\StreamInterface;

/**
 * Contact list response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactListResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = 'array<'.Contact::class.'>';

    /**
     * {@inheritDoc}
     *
     * @return Contact[]
     */
    public function deserialize($format = self::JSON)
    {
        $object = parent::deserialize($format);
        
        if (! is_array($object)) {
            $this->throwDeserializationException($format);
        }

        return $object;
    }

    /**
     * {@inheritDoc}
     */
    public function getBody(): StreamInterface
    {
        $array = json_decode(parent::getBody(), true);

        if (key_exists('export', $array)) {
            $array = $array['export'];
        }

        $stream = Utils::streamFor();
        $stream->write((string) json_encode($array));

        return $stream;
    }
}
