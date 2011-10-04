<?php

namespace Lime\CalendarBundle\Tests\Model;

class EventManagerTest extends \PHPUnit_Framework_TestCase
{

    protected $eventManager;

    public function __construct()
    {
        $this->eventManager = new Impl\EventManagerImpl('Lime\\CalendarBundle\\Tests\\Model\\Impl\\EventImpl');
    }

    public function testCreateEvent()
    {
        $eventManager = $this->eventManager;

        $calendar = new Impl\CalendarImpl();
        $event = $eventManager->createEvent($calendar);

        $this->assertTrue($event instanceof Impl\EventImpl);
        $this->assertEquals($calendar, $event->getCalendar());

        return $event;
    }

}
