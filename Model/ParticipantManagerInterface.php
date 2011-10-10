<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface ParticipantManagerInterface
{

    function getClass();

    /**
     * @return EventInterface
     */
    function getParticipant(UserInterface $user, EventInterface $event);

}
