<?php

namespace Macure\JojkaSDK\Http\Response;

use Macure\JojkaSDK\Models\CampaignRecipientsStatus;

/**
 * Campaign Recipients Status Response
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignRecipientsStatusResponse extends Response
{
    /**
     * Deserialize type
     *
     * @var string
     */
    protected $deserializeType = 'array<'.CampaignRecipientsStatus::class.'>';

     /**
     * {@inheritDoc}
     *
     * @return CampaignRecipientsStatus[]
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
