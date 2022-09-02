<?php

namespace Macure\JojkaSDK\Models;

use DateTime;
use JMS\Serializer\Annotation as JMS;

/**
 * Reply model
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class Reply
{
    /**
     * Inserted
     *
     * @JMS\Type("DateTime<'Y-m-d H:i:s'>")
     * 
     * @var DateTime
     */
    private $inserted;

    /**
     * Sender
     *
     * @JMS\Type("string")
     * 
     * @var string
     */
    private $sender;

    /**
     * Message
     *
     * @JMS\Type("string")
     * 
     * @var string
     */
    private $message;

    /**
     * Get inserted
     *
     * @return DateTime
     */ 
    public function getInserted()
    {
        return $this->inserted;
    }

    /**
     * Set inserted
     *
     * @param DateTime $inserted  Inserted
     *
     * @return self
     */ 
    public function setInserted(DateTime $inserted)
    {
        $this->inserted = $inserted;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string
     */ 
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set sender
     *
     * @param string $sender  Sender
     *
     * @return self
     */ 
    public function setSender(string $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param string $message  Message
     *
     * @return self
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }
}
