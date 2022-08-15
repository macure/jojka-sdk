<?php

namespace Macure\JojkaSDK\Tests\Models;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Message;

/**
 * Message test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class MessageTest extends TestCase
{
    /**
     * Campaign
     *
     * @var Message
     */
    private $message;

    /**
     * {@inheritDoc}
     */
    protected function setUp() : void 
    {
        $this->message = new Message();
    }

    /**
     * Test should set id
     *
     * @return void
     */
    public function testShouldSetId()
    {
        $this->message->setId(116690855);

        $this->assertEquals(116690855, $this->message->getId());
    }
}
