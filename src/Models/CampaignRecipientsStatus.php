<?php

namespace Macure\JojkaSDK\Models;

use JMS\Serializer\Annotation as JMS;

/**
 * Campaign recipients status model
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignRecipientsStatus
{
    public const STATUS_SENT = 'SENT';
    public const STATUS_ERROR = 'ERROR';
    public const STATUS_DELIVERED = 'DELIVERED';
    
    /**
     * Receiver
     *
     * @JMS\Type("string")
     * 
     * @var string
     */
    private $receiver;

    /**
     * Message id
     *
     * @JMS\Type("integer")
     * 
     * @var int
     */
    private $messageId;

    /**
     * Status
     *
     * @JMS\Type("string")
     * 
     * @var string
     */
    private $status;

    /**
     * Get receiver
     *
     * @return string
     */ 
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set receiver
     *
     * @param string $receiver  Receiver
     *
     * @return self
     */ 
    public function setReceiver(string $receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get message id
     *
     * @return int
     */ 
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set message id
     *
     * @param int $messageId  Message id
     *
     * @return self
     */ 
    public function setMessageId(int $messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status  Status
     *
     * @return self
     */ 
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }
}
