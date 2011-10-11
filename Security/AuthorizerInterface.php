<?php

namespace Lime\CalendarBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Lime\CalendarBundle\Model\EventInterface;

interface AuthorizerInterface
{

    public function canViewCalendar(CalendarInterface $calendar, UserInterface $user = null);

    public function canEditCalendar(CalendarInterface $calendar, UserInterface $user = null);

    public function canCreateCalendar(UserInterface $user = null);

    public function canDeleteCalendar(CalendarInterface $calendar, UserInterface $user = null);

    public function canViewEvent(EventInterface $event, UserInterface $user = null);

    public function canEditEvent(EventInterface $event, UserInterface $user = null);

    public function canCreateEvent(CalendarInterface $calendar, UserInterface $user = null);

    public function canDeleteEvent(EventInterface $event, UserInterface $user = null);

}
