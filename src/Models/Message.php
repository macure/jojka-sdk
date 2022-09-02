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
     * @JMS\Type("string")
     * @JMS\SerializedName("message_id")
     * 
     * @var string
     */
    private $id;

    /**
     * Get id
     *
     * @return string
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param string $id ID
     *
     * @return self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
