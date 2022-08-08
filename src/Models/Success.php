<?php

namespace Macure\JojkaSDK\Models;

use JMS\Serializer\Annotation as JMS;

/**
 * Success model
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class Success
{
    public const STATUS_DONE = 'done';

    /**
     * Successes
     *
     * @JMS\Type("string")
     * 
     * @var string
     */
    private $successes;

    /**
     * Is done
     *
     * @return bool
     */
    public function isDone() 
    {
        return self::STATUS_DONE === $this->successes; 
    }

    /**
     * Set successes
     *
     * @param string $successes  Successes
     *
     * @return self
     */ 
    public function setSuccesses(string $successes)
    {
        $this->successes = $successes;

        return $this;
    }
}
