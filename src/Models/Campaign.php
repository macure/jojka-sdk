<?php

namespace Macure\JojkaSDK\Models;

use JMS\Serializer\Annotation as JMS;

/**
 * Campaign model
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class Campaign
{
    /**
     * ID
     * 
     * @JMS\Type("integer")
     * @JMS\SerializedName("campaign_id")
     * 
     * @var int
     */
    protected $id;

    /**
     * Get iD
     *
     * @return int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set iD
     *
     * @param int $id  ID
     *
     * @return self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }
}
