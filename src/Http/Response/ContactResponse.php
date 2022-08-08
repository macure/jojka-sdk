<?php

namespace Macure\JojkaSDK\Http\Response;

use GuzzleHttp\Psr7\Utils;
use Macure\JojkaSDK\Models\Contact;
use Psr\Http\Message\StreamInterface;

/**
 * Contact Response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = Contact::class;

    /**
     * {@inheritDoc}
     *
     * @return Contact
     */
    public function deserialize($format = self::JSON)
    {
        $object = parent::deserialize($format);

        if (! $object instanceof Contact) {
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

        if (key_exists('group', $array)) {
            $array['groups'] = [$array['group']];
        }

        $stream = Utils::streamFor();
        $stream->write((string) json_encode($array));

        return $stream;
    }
}
