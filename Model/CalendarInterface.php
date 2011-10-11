<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Blamer\BlamableInterface;

interface CalendarInterface extends BlamableInterface
{

    const VISIBILITY_HIDDEN = 1;
    const VISIBILITY_PRIVATE = 2;
    const VISIBILITY_PUBLIC = 4;

    const ROLE_VIEW = 1;
    const ROLE_CONTRIBUTE = 2;
    const ROLE_ADMIN = 4;

    function getId();

    function setCreatedAt(\DateTime $created_at);

    function getCreatedAt();

    function setUpdatedAt(\DateTime $updated_at);

    function getUpdatedAt();

    function addMembership(MembershipInterface $membership);

    function getMemberships();

    function addEvent(EventInterface $event);

    function getEvents();

    function setVisibility($visibility);

    function getVisibility();

    function setName($name);

    function getName();

    function setDescription($description);

    function getDescription();

    function isPublic();

    function isPrivate();

    function isHidden();

}
