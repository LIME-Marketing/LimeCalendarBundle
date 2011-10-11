<?php

namespace Lime\CalendarBundle\Security;

use Lime\CalendarBundle\Model\CalendarManagerInterface;
use Lime\CalendarBundle\Model\EventManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Lime\CalendarBundle\Model\EventInterface;

class Authorizer implements AuthorizerInterface
{

    /**
     * @var UserProviderInterface
     */
    protected $userProvider;

    /**
     * @var CalendarManagerInterface
     */
    protected $calendarManager;

    /**
     * @var EventManagerInterface
     */
    protected $eventManager;

    public function __construct(UserProviderInterface $userProvider, CalendarManagerInterface $calendarManager, EventManagerInterface $eventManager)
    {
        $this->userProvider = $userProvider;
        $this->calendarManager = $calendarManager;
        $this->eventManager = $eventManager;
    }

    public function canViewCalendar(CalendarInterface $calendar, UserInterface $user = null)
    {
        return $calendar->isPublic() || $calendar->getUser() === $this->getUser($user) || $this->calendarManager->isMember($this->getUser($user), $calendar);
    }

    public function canEditCalendar(CalendarInterface $calendar, UserInterface $user = null)
    {
        return $calendar->getUser() === $this->getUser($user) || $this->calendarManager->hasRole(CalendarInterface::ROLE_ADMIN, $this->getUser($user), $calendar);
    }

    public function canCreateCalendar(UserInterface $user = null)
    {
        return null !== $this->getUser($user);
    }

    public function canDeleteCalendar(CalendarInterface $calendar, UserInterface $user = null)
    {
        return $calendar->getUser() === $this->getUser($user) || $this->calendarManager->hasRole(CalendarInterface::ROLE_ADMIN, $this->getUser($user), $calendar);
    }

    public function canViewEvent(EventInterface $event, UserInterface $user = null)
    {
        return $this->canViewCalendar($this->getUser($user), $event->getCalendar()) && ($event->isPublic() || $event->getUser() === $this->getUser($user) || $this->eventManager->isParticipant($this->getUser($user), $event));
    }

    public function canEditEvent(EventInterface $event, UserInterface $user = null)
    {
        return $this->canViewCalendar($this->getUser($user), $event->getCalendar()) && ($event->getUser() === $this->getUser($user) || $this->eventManager->hasRole(EventInterface::ROLE_ADMIN, $this->getUser($user), $event));
    }

    public function canCreateEvent(CalendarInterface $calendar, UserInterface $user = null)
    {
        return $this->canViewCalendar($this->getUser($user), $calendar) && ($calendar->getUser() === $this->getUser($user) || $this->calendarManager->hasRole(array(CalendarInterface::ROLE_ADMIN, CalendarInterface::ROLE_CONTRIBUTE), $this->getUser($user), $calendar));
    }

    public function canDeleteEvent(EventInterface $event, UserInterface $user = null)
    {
        return $this->canViewCalendar($this->getUser($user), $event->getCalendar()) && ($event->getUser() === $this->getUser($user) || $this->eventManager->hasRole(EventInterface::ROLE_ADMIN, $this->getUser($user), $event));
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    protected function getUser(UserInterface $user = null)
    {
        if (null === $user) {
            return $this->userProvider->getUser();
        }

        return $user;
    }

}
