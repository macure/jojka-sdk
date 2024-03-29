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
        $array = parent::deserialize($format);
                
        if (empty($array) || ! is_array($array) ) {
            $this->throwDeserializationException($format);
        }

        return $array;
    }

    /**
     * {@inheritDoc}
     */
    public function getBody(): StreamInterface
    {
        $array = json_decode(parent::getBody(), true);

        if (is_array($array) && key_exists('export', $array)) {
            $array = $array['export'];
        }

        return Utils::streamFor($array ? (string) json_encode($array) : "");;
    }
}
