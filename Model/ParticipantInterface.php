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

    /**
     * @return \DateTime created time
     */
    function getCreatedAt();

    /**
     * @return \DateTime last updated time
     */
    function getUpdatedAt();

    function setEvent(EventInterface $event);

    function getEvent();

    /**
     * Time that participation expires (null for never)
     * This is necessary so that participants can drop their participation at
     * some point in the future while still allowing shallow copies of Events
     *
     * @param \DateTime $expiry
     */
    function setExpiry(\DateTime $expiry = null);

    /**
     * @return \DateTime time participation expires
     */
    function getExpiry();

    function setUser(UserInterface $user);

    function getUser();

    function setRole($role);

    function getRole();
}
