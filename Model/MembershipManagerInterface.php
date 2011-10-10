<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface MembershipManagerInterface
{

    function getClass();

    /**
     * @return MembershipInterface
     */
    function getMembership(UserInterface $user, CalendarInterface $calendar);

}
