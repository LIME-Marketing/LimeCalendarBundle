<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class CalendarManager implements CalendarManagerInterface
{

    /**
     * @return CalendarInterface
     */
    public function createCalendar()
    {
        $class = $this->getClass();
        $calendar = new $class();

        return $calendar;
    }

}
