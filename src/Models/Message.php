<?php

namespace Macure\JojkaSDK\Models;

use JMS\Serializer\Annotation as JMS;

/**
 * Message model
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class Message
{
    public const STATUS_SENT = 'SENT';
    public const STATUS_ERROR = 'ERROR';
    public const STATUS_DELIVERED = 'DELIVERED';
    
    /**
     * ID
     * 
     * @JMS\Type("integer")
     * @JMS\SerializedName("message_id")
     * 
     * @var int
     */
    private $id;

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
