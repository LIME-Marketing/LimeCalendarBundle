<?php

namespace Lime\CalendarBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Lime\CalendarBundle\Model\EventInterface;

interface AuthorizerInterface
{

    public function canViewCalendar(UserInterface $user, CalendarInterface $calendar);

    public function canEditCalendar(UserInterface $user, CalendarInterface $calendar);

    public function canCreateCalendar(UserInterface $user);

    public function canDeleteCalendar(UserInterface $user, CalendarInterface $calendar);

    public function canViewEvent(UserInterface $user, EventInterface $event);

    public function canEditEvent(UserInterface $user, EventInterface $event);

    public function canCreateEvent(UserInterface $user, CalendarInterface $calendar);

    public function canDeleteEvent(UserInterface $user, EventInterface $event);

}
