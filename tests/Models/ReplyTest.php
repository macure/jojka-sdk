<?php

namespace Macure\JojkaSDK\Tests\Models;

use DateTime;
use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Reply;

/**
 * Reply test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ReplyTest extends TestCase
{
    /**
     * Campaign
     *
     * @var Reply
     */
    private $reply;

    /**
     * {@inheritDoc}
     */
    protected function setUp() : void 
    {
        $this->reply = new Reply();
    }

    /**
     * Test should set id
     *
     * @return void
     */
    public function testShouldSetInserted()
    {
        $date = new DateTime();

        $this->reply->setInserted($date);
        $this->assertEquals($date, $this->reply->getInserted());
    }

    /**
     * Test should set sender
     *
     * @return void
     */
    public function testShouldSetSender()
    {
        $this->reply->setSender("46709771337");
        $this->assertEquals("46709771337", $this->reply->getSender());
    }

    /**
     * Test should set message
     *
     * @return void
     */
    public function testShouldSetMessage()
    {
        $this->reply->setMessage("Sure");
        $this->assertEquals("Sure", $this->reply->getMessage());
    }
}
