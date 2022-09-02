<?php

namespace Macure\JojkaSDK\Http\Response;

use Macure\JojkaSDK\Models\Campaign;

/**
 * Campaign Response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = Campaign::class;

    /**
     * {@inheritDoc}
     *
     * @return Campaign
     */
    public function deserialize($format = self::JSON)
    {
        $object = parent::deserialize($format);

        if (! $object instanceof Campaign) {
            $this->throwDeserializationException($format);
        }

        return $object;
    }
}
