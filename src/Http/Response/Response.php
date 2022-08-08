<?php

namespace Macure\JojkaSDK\Http\Response;

use JMS\Serializer\SerializerBuilder;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Macure\JojkaSDK\Exceptions\DeserializationException;

/**
 * Response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class Response extends Psr7Response
{
    public const JSON = 'json';

    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = 'object';

    /**
     * Deserialize
     * 
     * @param string $format
     * 
     * @return mixed Deserialized object
     */
    public function deserialize($format = self::JSON)
    {
        $serializer = SerializerBuilder::create()->build();
		$object = $serializer->deserialize($this->getBody(), $this->deserializeType, $format);

		return $object;
    }

    /**
     * Throw Deserialization exception
     *
     * @param string $format
     *
     * @return void
     * 
     * @throws DeserializationException
     */
    protected function throwDeserializationException($format)
    {
        throw new DeserializationException(sprintf('Deserialization of %s to %s failed', $format, $this->deserializeType));
    }
}