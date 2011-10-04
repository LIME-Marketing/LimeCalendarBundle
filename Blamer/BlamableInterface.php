<?php

namespace Lime\CalendarBundle\Blamer;

use Symfony\Component\Security\Core\User\UserInterface;

interface BlamableInterface
{

    function setUser(UserInterface $user);

    /**
     * @return UserInterface
     */
    function getUser();

}
