<?php

namespace Lime\CalendarBundle\Security;

use Lime\CalendarBundle\Model\CalendarManagerInterface;
use Lime\CalendarBundle\Model\EventManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Lime\CalendarBundle\Model\EventInterface;

class Authorizer implements AuthorizerInterface
{

    protected $calendarManager;
    protected $eventManager;

    public function __construct(CalendarManagerInterface $calendarManager, EventManagerInterface $eventManager)
    {
        $this->calendarManager = $calendarManager;
        $this->eventManager = $eventManager;
    }

    public function canViewCalendar(UserInterface $user, CalendarInterface $calendar)
    {
        return $calendar->isPublic() || $calendar->getUser() === $user || $this->calendarManager->isMember($user, $calendar);
    }

    public function canEditCalendar(UserInterface $user, CalendarInterface $calendar)
    {
        return $calendar->getUser() === $user || $this->calendarManager->hasRole(CalendarInterface::ROLE_ADMIN, $user, $calendar);
    }

    public function canCreateCalendar(UserInterface $user)
    {
        return true;
    }

    public function canDeleteCalendar(UserInterface $user, CalendarInterface $calendar)
    {
        return $calendar->getUser() === $user || $this->calendarManager->hasRole(CalendarInterface::ROLE_ADMIN, $user, $calendar);
    }

    public function canViewEvent(UserInterface $user, EventInterface $event)
    {
        return $this->canViewCalendar($user, $event->getCalendar()) && ($event->isPublic() || $event->getUser() === $user || $this->eventManager->isParticipant($user, $event));
    }

    public function canEditEvent(UserInterface $user, EventInterface $event)
    {
        return $this->canViewCalendar($user, $event->getCalendar()) && ($event->getUser() === $user || $this->eventManager->hasRole(EventInterface::ROLE_ADMIN, $user, $event));
    }

    public function canCreateEvent(UserInterface $user, CalendarInterface $calendar)
    {
        return $this->canViewCalendar($user, $calendar) && ($calendar->getUser() === $user || $this->calendarManager->hasRole(array(CalendarInterface::ROLE_ADMIN, CalendarInterface::ROLE_CONTRIBUTE), $user, $calendar));
    }

    public function canDeleteEvent(UserInterface $user, EventInterface $event)
    {
        return $this->canViewCalendar($user, $event->getCalendar()) && ($event->getUser() === $user || $this->eventManager->hasRole(EventInterface::ROLE_ADMIN, $user, $event));
    }

}
