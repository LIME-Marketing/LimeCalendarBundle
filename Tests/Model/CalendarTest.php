<?php

namespace Lime\CalendarBundle\Tests\Model;

class CalendarTest extends \PHPUnit_Framework_TestCase
{

    public function testGettersSetters()
    {
        $calendar = new Impl\CalendarImpl();

        $this->assertTrue(null === $calendar->getId());

        $this->assertTrue(null === $calendar->getCreatedAt());

        $this->assertTrue(null === $calendar->getUpdatedAt());

        $this->assertNull($calendar->getUser());
        $owner = new Impl\UserImpl(1, 'foo-user');
        $calendar->setUser($owner);
        $this->assertEquals($owner, $calendar->getUser());

        $this->assertTrue(is_array($calendar->getEvents()));
        $this->assertTrue(0 === count($calendar->getEvents()));
        $event = new Impl\EventImpl();
        $calendar->addEvent($event);
        $this->assertTrue(in_array($event, $calendar->getEvents()));
        $this->assertTrue(1 === count($calendar->getEvents()));

        $this->assertTrue(is_array($calendar->getMemberships()));
        $this->assertEquals(0, count($calendar->getMemberships()));
        $membership = new Impl\MembershipImpl();
        $calendar->addMembership($membership);
        $this->assertContains($membership, $calendar->getMemberships());
        $this->assertEquals(1, count($calendar->getMemberships()));

        $this->assertTrue(null === $calendar->getVisibility());
        $calendar->setVisibility(Impl\CalendarImpl::VISIBILITY_PRIVATE);
        $this->assertTrue(Impl\CalendarImpl::VISIBILITY_PRIVATE === $calendar->getVisibility());
    }

}
