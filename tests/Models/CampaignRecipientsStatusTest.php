<?php

namespace Macure\JojkaSDK\Tests\Models;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\CampaignRecipientsStatus;

/**
 * Campaign recipients status test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignRecipientsStatusTest extends TestCase
{
    /**
     * Campaign recipients status
     *
     * @var CampaignRecipientsStatus
     */
    private $campaignRecipientsStatus;

    /**
     * {@inheritDoc}
     */
    protected function setUp() : void 
    {
        $this->campaignRecipientsStatus = new CampaignRecipientsStatus();
    }

    /**
     * Test should set message id
     *
     * @return void
     */
    public function testShouldSetMessageId()
    {
        $this->campaignRecipientsStatus->setMessageId(1900607);

        $this->assertEquals(1900607, $this->campaignRecipientsStatus->getMessageId());
    }

    /**
     * Test should set receiver
     *
     * @return void
     */
    public function testShouldSetReceiver()
    {
        $this->campaignRecipientsStatus->setReceiver("4670903xxxxxx");

        $this->assertEquals("4670903xxxxxx", $this->campaignRecipientsStatus->getReceiver());
    }

    /**
     * Test should set status
     *
     * @return void
     */
    public function testShouldSetStatus()
    {
        $this->campaignRecipientsStatus->setStatus(CampaignRecipientsStatus::STATUS_SENT);

        $this->assertEquals(CampaignRecipientsStatus::STATUS_SENT, $this->campaignRecipientsStatus->getStatus());
    }
}
