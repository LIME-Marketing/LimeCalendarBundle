<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface ParticipantInterface
{
    const ROLE_VIEW = 1;
    const ROLE_CONTRIBUTE = 2;
    const ROLE_ADMIN = 4;
    const ROLE_OWNER = 8;

    function getId();

    function getCreatedAt();

    function getUpdatedAt();

    function setUser(UserInterface $user);

    function getUser();

    function setRole($role);

    function getRole();
}
