<?php

namespace Macure\JojkaSDK\Tests\Models;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Campaign;

/**
 * Campaign test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class CampaignTest extends TestCase
{
    /**
     * Campaign
     *
     * @var Campaign
     */
    private $campaign;

    /**
     * {@inheritDoc}
     */
    protected function setUp() : void 
    {
        $this->campaign = new Campaign();
    }

    /**
     * Test should set id
     *
     * @return void
     */
    public function testShouldSetId()
    {
        $this->campaign->setId(550);

        $this->assertEquals(550, $this->campaign->getId());
    }
}
