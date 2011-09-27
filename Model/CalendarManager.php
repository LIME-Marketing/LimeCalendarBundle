<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class CalendarManager implements CalendarManagerInterface
{
    
    public function createCalendar(UserInterface $owner, $visibility = CalendarInterface::VISIBILITY_PUBLIC)
    {
        $class = $this->getClass();
        $calendar = new $class();
        
        $calendar->setOwner($owner);
        $calendar->setVisibility($visibility);
        
        return $calendar;
    }

}
