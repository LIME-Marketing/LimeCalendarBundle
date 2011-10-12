<?php

namespace Lime\CalendarBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Lime\CalendarBundle\Security\AuthorizerInterface;
use Lime\CalendarBundle\Model\CalendarManagerInterface;
use Lime\CalendarBundle\Model\EventManagerInterface;
use Lime\CalendarBundle\Model\MembershipManagerInterface;
use Lime\CalendarBundle\Model\ParticipantManagerInterface;

abstract class BaseController extends ContainerAware
{

    /**
     * @return AuthorizerInterface
     */
    protected function getAuthorizer()
    {
        return $this->container->get('lime_calendar.authorizer');
    }

    /**
     * @return CalendarManagerInterface
     */
    protected function getCalendarManager()
    {
        return $this->container->get('lime_calendar.manager.calendar');
    }

    /**
     * @return EventManagerInterface
     */
    protected function getEventManager()
    {
        return $this->container->get('lime_calendar.manager.event');
    }

    /**
     * @return MembershipManagerInterface
     */
    protected function getMembershipManager()
    {
        return $this->container->get('lime_calendar.manager.membership');
    }

    /**
     * @return ParticipantManagerInterface
     */
    protected function getParticipantManager()
    {
        return $this->container->get('lime_calendar.manager.participant');
    }

}
