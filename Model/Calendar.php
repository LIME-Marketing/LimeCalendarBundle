<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class Calendar implements CalendarInterface
{

    protected $id;
    protected $created_at;
    protected $updated_at;
    protected $owner;
    protected $participants = array();
    protected $events = array();
    protected $visibility;

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setOwner(UserInterface $owner)
    {
        $this->owner = $owner;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function addParticipant(CalendarParticipantInterface $participant)
    {
        $this->participants[] = $participant;
    }

    public function getParticipants()
    {
        return $this->participants;
    }

    public function addEvent(EventInterface $event)
    {
        $this->events[] = $event;
    }

    public function getEvents()
    {
        return $this->events;
    }
    
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }
    
    public function getVisibility()
    {
        return $this->visibility;
    }

}
