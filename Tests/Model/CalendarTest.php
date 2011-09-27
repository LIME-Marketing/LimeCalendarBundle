<?php

namespace Lime\CalendarBundle\Tests\Model;

use Lime\CalendarBundle\Tests\Model\Impl\CalendarImpl;
use Lime\CalendarBundle\Tests\Model\Impl\UserImpl;
use Lime\CalendarBundle\Tests\Model\Impl\EventImpl;
use Lime\CalendarBundle\Tests\Model\Impl\CalendarParticipantImpl;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGettersSetters()
    {
        $calendar = new CalendarImpl();
        
        $this->assertTrue(null === $calendar->getId());
        
        $this->assertTrue(null === $calendar->getCreatedAt());
        
        $this->assertTrue(null === $calendar->getUpdatedAt());
        
        $this->assertTrue(null === $calendar->getOwner());
        $owner = new UserImpl(1, 'foo-user');
        $calendar->setOwner($owner);
        $this->assertTrue($calendar->getOwner() === $owner);
        
        $this->assertTrue(is_array($calendar->getEvents()));
        $this->assertTrue(0 === count($calendar->getEvents()));
        $event = new EventImpl();
        $calendar->addEvent($event);
        $this->assertTrue(in_array($event, $calendar->getEvents()));
        $this->assertTrue(1 === count($calendar->getEvents()));
        
        $this->assertTrue(is_array($calendar->getParticipants()));
        $this->assertTrue(0 === count($calendar->getParticipants()));
        $participant = new CalendarParticipantImpl();
        $calendar->addParticipant($participant);
        $this->assertTrue(in_array($participant, $calendar->getParticipants()));
        $this->assertTrue(1 === count($calendar->getParticipants()));
        
        $this->assertTrue(null === $calendar->getVisibility());
        $calendar->setVisibility(CalendarImpl::VISIBILITY_PRIVATE);
        $this->assertTrue(CalendarImpl::VISIBILITY_PRIVATE === $calendar->getVisibility());
    }

}
