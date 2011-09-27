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
        
        $owner = new Impl\UserImpl(1, 'foo-user');
        $startDate = new \DateTime();
        $endDate = new \DateTime('+3 hours');
        $event = $eventManager->createEvent($owner, $startDate, $endDate, Impl\EventImpl::VISIBILITY_HIDDEN);
        
        $this->assertTrue($event instanceof Impl\EventImpl);
        
        $this->assertTrue($event->getOwner() === $owner);
        $this->assertTrue($event->getStartDate() === $startDate);
        $this->assertTrue($event->getEndDate() === $endDate);
        $this->assertTrue($event->getVisibility() === Impl\EventImpl::VISIBILITY_HIDDEN);
        
        return $event;
    }

}
