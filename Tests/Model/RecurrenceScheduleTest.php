<?php

namespace Lime\CalendarBundle\Tests\Model;

use Lime\CalendarBundle\Tests\Model\Impl\EventImpl;
use Lime\CalendarBundle\Tests\Model\Impl\RecurrenceScheduleImpl;

class RecurrenceScheduleTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGettersSetters()
    {
        $schedule = new RecurrenceScheduleImpl(new \DateTime());
        
        $this->assertTrue(null === $schedule->getId());
        
        $this->assertTrue(null === $schedule->getCreatedAt());
        
        $this->assertTrue(null === $schedule->getUpdatedAt());
        
        $this->assertTrue($schedule->getStart() instanceof \DateTime);
        $start = new \DateTime();
        $schedule->setStart($start);
        $this->assertTrue($schedule->getStart() === $start);
        
        $this->assertTrue(null === $schedule->getEvent());
        $event = new EventImpl();
        $schedule->setEvent($event);
        $this->assertTrue($schedule->getEvent() === $event);
        try {
            $schedule->setEvent('foo');
            $this->assertTrue(false);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
        }
        
        $this->assertTrue(null === $schedule->getRecurrenceInterval());
        $interval = new \DateInterval('P1W');
        $schedule->setRecurrenceInterval($interval);
        $this->assertTrue($schedule->getRecurrenceInterval() === $interval);
        try {
            $schedule->setRecurrenceInterval('foo');
            $this->assertTrue(false);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
        }
        
        $this->assertTrue(null === $schedule->getLastRecurrence());
        $lastRecurrence = new \DateTime();
        $schedule->setLastRecurrence($lastRecurrence);
        $this->assertTrue($schedule->getLastRecurrence() === $lastRecurrence);
        try {
            $schedule->setLastRecurrence('foo');
            $this->assertTrue(false);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
        }
        
        $this->assertTrue(null === $schedule->getRecurUntil());
        $recurUntil = new \DateTime();
        $schedule->setRecurUntil($recurUntil);
        $this->assertTrue($schedule->getRecurUntil() === $recurUntil);
        try {
            $schedule->setRecurUntil('foo');
            $this->assertTrue(false);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
        }
        
        $this->assertTrue($schedule->getRecurrences() instanceof \DatePeriod);
        $this->assertTrue($schedule->getRecurrences(false) instanceof \DatePeriod);
    }

}
