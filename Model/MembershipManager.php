<?php

namespace Lime\CalendarBundle\Model;

abstract class MembershipManager implements MembershipManagerInterface
{

    /**
     * @param CalendarInterface $calendar
     * @return MembershipInterface
     */
    public function createMembership(CalendarInterface $calendar)
    {
        $class = $this->getClass();
        $membership = new $class();

        $membership->setCalendar($calendar);

        return $membership;
    }

}
