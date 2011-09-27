<?php

namespace Lime\CalendarBundle\Tests\Model;

class EventTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGettersSetters()
    {
        $event = new Impl\EventImpl();
        
        $this->assertTrue(null === $event->getId());
        
        $this->assertTrue(null === $event->getCreatedAt());
        
        $this->assertTrue(null === $event->getUpdatedAt());
        
        $this->assertTrue(null === $event->getParent());
        $parent = new Impl\EventImpl();
        $event->setParent($parent);
        $this->assertTrue($event->getParent() === $parent);
        $event->setParent(null);
        $this->assertTrue(null === $event->getParent());
        
        $this->assertTrue(is_array($event->getChildren()));
        $this->assertTrue(0 === count($event->getChildren()));
        $child = new Impl\EventImpl();
        $event->addChild($child);
        $this->assertTrue(in_array($child, $event->getChildren()));
        $this->assertTrue(1 === count($event->getChildren()));
        
        $this->assertTrue(is_array($event->getRecurrenceSchedules()));
        $this->assertTrue(0 === count($event->getRecurrenceSchedules()));
        $schedule = new Impl\RecurrenceScheduleImpl(new \DateTime());
        $event->addRecurrenceSchedule($schedule);
        $this->assertTrue(in_array($schedule, $event->getRecurrenceSchedules()));
        $this->assertTrue(1 === count($event->getRecurrenceSchedules()));
        
        $this->assertTrue(null === $event->getCalendar());
        $calendar = new Impl\CalendarImpl();
        $event->setCalendar($calendar);
        $this->assertTrue($event->getCalendar() === $calendar);
        
        $this->assertTrue(null === $event->getOwner());
        $owner = new Impl\UserImpl(1, 'foo-user');
        $event->setOwner($owner);
        $this->assertTrue($event->getOwner() === $owner);
        
        $this->assertTrue(is_array($event->getParticipants()));
        $this->assertTrue(0 === count($event->getParticipants()));
        $participant = new Impl\EventParticipantImpl();
        $event->addParticipant($participant);
        $this->assertTrue(in_array($participant, $event->getParticipants()));
        $this->assertTrue(1 === count($event->getParticipants()));
        
        $this->assertTrue(null === $event->getStartDate());
        $start_date = new \DateTime();
        $event->setStartDate($start_date);
        $this->assertTrue($event->getStartDate() === $start_date);
        
        $this->assertTrue(null === $event->getEndDate());
        $end_date = new \DateTime('+2 days');
        $event->setEndDate($end_date);
        $this->assertTrue($event->getEndDate() === $end_date);
        
        $diff = $start_date->diff($end_date)->format('%d days');
        $this->assertTrue($event->getLength() instanceof \DateInterval);
        $this->assertTrue($event->getLength()->format('%d days') === $diff);
        
        $this->assertTrue(null === $event->getVisibility());
        $event->setVisibility(Impl\EventImpl::VISIBILITY_HIDDEN);
        $this->assertTrue($event->getVisibility() === Impl\EventImpl::VISIBILITY_HIDDEN);
    }

}
