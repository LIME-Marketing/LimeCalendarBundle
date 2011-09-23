<?php

namespace Lime\CalendarBundle\Tests\Model;

use Lime\CalendarBundle\Model\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGettersSetters()
    {
        $event = new EventImpl();
        
        $this->assertTrue(null === $event->getId());
        
        $this->assertTrue(null === $event->getCreatedAt());
        
        $this->assertTrue(null === $event->getUpdatedAt());
        
        $this->assertTrue(null === $event->getParent());
        $parent = new EventImpl();
        $event->setParent($parent);
        $this->assertTrue($event->getParent() === $parent);
        $event->setParent(null);
        $this->assertTrue(null === $event->getParent());
        
        $this->assertTrue(is_array($event->getChildren()));
        $this->assertTrue(0 === count($event->getChildren()));
        $child = new EventImpl();
        $event->addChild($child);
        $this->assertTrue(in_array($child, $event->getChildren()));
        try {
            $event->addChild('foo');
            $this->assertTrue(false);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
        }
        
        $this->assertTrue(null === $event->getRecurrenceSchedules());
        
    }

}

class EventImpl extends Event
{
}
