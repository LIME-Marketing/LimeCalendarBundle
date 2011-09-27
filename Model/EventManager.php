<?php

namespace Lime\CalendarBundle\Model;

use Lime\CalendarBundle\Model\EventInterface;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class EventManager implements EventManagerInterface
{
    
    public function createEvent(UserInterface $owner, \DateTime $startDate, \DateTime $endDate, $visibility = EventInterface::VISIBILITY_PUBLIC)
    {
        $class = $this->getClass();
        $event = new $class();
        
        $event->setOwner($owner);
        $event->setStartDate($startDate);
        $event->setEndDate($endDate);
        $event->setVisibility($visibility);
        
        return $event;
    }

}
