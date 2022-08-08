<?php

namespace Macure\JojkaSDK\Models;

use JMS\Serializer\Annotation as JMS;

/**
 * Contact model
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class Contact
{
    /**
     * ID
     * 
     * @JMS\Type("string")
     * 
     * @var string
     */
    protected $msisdn;

    /**
     * Name
     *
     * @JMS\Type("string")
     * 
     * @var string
     */
    protected $name;

    /**
     * Groups
     *
     * @JMS\Type("array")
     * 
     * @var string[]
     */
    protected $groups;

    /**
     * Get id
     *
     * @return string
     */ 
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * Set id
     *
     * @param string $msisdn  ID
     *
     * @return self
     */ 
    public function setMsisdn(string $msisdn)
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name  Name
     *
     * @return self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get groups
     *
     * @return string[]
     */ 
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set groups
     *
     * @param string[] $groups  Groups
     *
     * @return self
     */ 
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }
}
