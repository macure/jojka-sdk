<?php

namespace Macure\JojkaSDK\Tests\Models;

use PHPUnit\Framework\TestCase;
use Macure\JojkaSDK\Models\Contact;

/**
 * Contact model test
 * 
 * @author Vladimir Simic <vladimir.simic@prodevcon.ch>
 */
class ContactTest extends TestCase
{
    /**
     * Contact
     *
     * @var Contact
     */
    private $contact;

    /**
     * {@inheritDoc}
     */
    protected function setUp() : void 
    {
        $this->contact = new Contact();
    }

    /**
     * Test should set msisdn
     *
     * @return void
     */
    public function testShouldSetMsisdn()
    {
        $this->contact->setMsisdn("46709771337");

        $this->assertEquals('46709771337', $this->contact->getMsisdn());
    }

    /**
     * Test should set name
     *
     * @return void
     */
    public function testShouldSetName()
    {
        $this->contact->setName("Lilleman");

        $this->assertEquals('Lilleman', $this->contact->getName());
    } 

    /**
     * Test should set name
     *
     * @return void
     */
    public function testShouldSetGroups()
    {
        $this->contact->setGroups(["Utvecklare", "Jojka personal"]);

        $this->assertIsArray($this->contact->getGroups());
    } 
}
