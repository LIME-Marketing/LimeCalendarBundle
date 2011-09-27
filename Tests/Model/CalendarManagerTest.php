<?php

namespace Lime\CalendarBundle\Tests\Model;

class CalendarManagerTest extends \PHPUnit_Framework_TestCase
{
    
    protected $calendarManager;
    
    public function __construct()
    {
        $this->calendarManager = new Impl\CalendarManagerImpl('Lime\\CalendarBundle\\Tests\\Model\\Impl\\CalendarImpl');
    }
    
    public function testCreateCalendar()
    {
        $calendarManager = $this->calendarManager;
        
        $owner = new Impl\UserImpl(1, 'foo-user');
        
        $calendar = $calendarManager->createCalendar($owner, Impl\CalendarImpl::VISIBILITY_HIDDEN);
        
        $this->assertTrue($calendar instanceof Impl\CalendarImpl);
        
        $this->assertTrue($calendar->getOwner() === $owner);
        $this->assertTrue($calendar->getVisibility() === Impl\CalendarImpl::VISIBILITY_HIDDEN);
        
        return $calendar;
    }

}
