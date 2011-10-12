<?php

namespace Lime\CalendarBundle\Security;

use Lime\CalendarBundle\Model\CalendarManagerInterface;
use Lime\CalendarBundle\Model\EventManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Lime\CalendarBundle\Model\EventInterface;
use Lime\CalendarBundle\Model\MembershipInterface;
use Lime\CalendarBundle\Model\ParticipantInterface;

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
        $user = $this->getUser($user);
        return null === $user ? false : $calendar->isPublic() || $calendar->getUser() === $user || $this->calendarManager->isMember($user, $calendar);
    }

    public function canEditCalendar(CalendarInterface $calendar, UserInterface $user = null)
    {
        $user = $this->getUser($user);
        return null === $user ? false : $calendar->getUser() === $user || $this->calendarManager->hasRole(MembershipInterface::ROLE_ADMIN, $user, $calendar);
    }

    public function canCreateCalendar(UserInterface $user = null)
    {
        return null !== $this->getUser($user);
    }

    public function canDeleteCalendar(CalendarInterface $calendar, UserInterface $user = null)
    {
        $user = $this->getUser($user);
        return null === $user ? false : $calendar->getUser() === $user || $this->calendarManager->hasRole(MembershipInterface::ROLE_ADMIN, $user, $calendar);
    }

    public function canViewEvent(EventInterface $event, UserInterface $user = null)
    {
        $user = $this->getUser($user);
        return null === $user ? false : $this->canViewCalendar($user, $event->getCalendar()) && ($event->isPublic() || $event->getUser() === $user || $this->eventManager->isParticipant($user, $event));
    }

    public function canEditEvent(EventInterface $event, UserInterface $user = null)
    {
        $user = $this->getUser($user);
        return null === $user ? false : $this->canViewCalendar($user, $event->getCalendar()) && ($event->getUser() === $user || $this->eventManager->hasRole(ParticipantInterface::ROLE_ADMIN, $user, $event));
    }

    public function canCreateEvent(CalendarInterface $calendar, UserInterface $user = null)
    {
        $user = $this->getUser($user);
        return null === $user ? false : $this->canViewCalendar($user, $calendar) && ($calendar->getUser() === $user || $this->calendarManager->hasRole(array(MembershipInterface::ROLE_ADMIN, MembershipInterface::ROLE_CONTRIBUTE), $user, $calendar));
    }

    public function canDeleteEvent(EventInterface $event, UserInterface $user = null)
    {
        $user = $this->getUser($user);
        return null === $user ? false : $this->canViewCalendar($user, $event->getCalendar()) && ($event->getUser() === $user || $this->eventManager->hasRole(ParticipantInterface::ROLE_ADMIN, $user, $event));
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    protected function getUser(UserInterface $user = null)
    {
        if (null === $user) {
            return is_object($this->userProvider->getUser()) ? $this->userProvider->getUser() : null;
        }

        return $user;
    }

}
