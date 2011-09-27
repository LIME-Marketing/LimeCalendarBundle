<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface CalendarInterface
{
    
    const VISIBILITY_HIDDEN = 1;
    const VISIBILITY_PRIVATE = 2;
    const VISIBILITY_PUBLIC = 4;
    
    public function getId();

    public function getCreatedAt();

    public function getUpdatedAt();

    public function setOwner(UserInterface $owner);

    public function getOwner();

    public function addParticipant(CalendarParticipantInterface $participant);

    public function getParticipants();

    public function addEvent(EventInterface $event);

    public function getEvents();

    public function setVisibility($visibility);

    public function getVisibility();

}
