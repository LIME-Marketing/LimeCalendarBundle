<?php

namespace Lime\CalendarBundle\Model;

use Lime\CalendarBundle\Model\EventInterface;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class EventManager implements EventManagerInterface
{

    /**
     * @return EventInterface
     */
    public function createEvent(CalendarInterface $calendar)
    {
        $class = $this->getClass();
        $event = new $class();

        $event->setCalendar($calendar);

        return $event;
    }

}
