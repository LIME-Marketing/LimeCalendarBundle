<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class Event implements EventInterface
{

    protected $id;
    protected $created_at;
    protected $updated_at;
    protected $calendar;
    protected $owner;
    protected $participants = array();
    protected $start_date;
    protected $end_date;
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

    public function setCalendar(CalendarInterface $calendar)
    {
        $this->calendar = $calendar;
    }

    public function getCalendar()
    {
        return $this->calendar;
    }

    public function setOwner(UserInterface $owner)
    {
        $this->owner = $owner;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function addParticipant(EventParticipantInterface $participant)
    {
        $this->participants[] = $participant;
    }

    public function getParticipants()
    {
        return $this->participants;
    }
    
    public function setStartDate(\DateTime $start_date)
    {
        $this->start_date = $start_date;
    }
    
    public function getStartDate()
    {
        return $this->start_date;
    }
    
    public function setEndDate(\DateTime $end_date)
    {
        $this->end_date = $end_date;
    }
    
    public function getEndDate()
    {
        return $this->end_date;
    }
    
    public function getLength()
    {
        return $this->start_date->diff($this->end_date);
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
