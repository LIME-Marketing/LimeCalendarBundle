<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class Event implements EventInterface
{

    protected $id;
    protected $created_at;
    protected $updated_at;
    protected $parent;
    protected $children = array();
    protected $recurrence_schedules = array();
    protected $calendar;
    protected $user;
    protected $participants = array();
    protected $start_date;
    protected $end_date;
    protected $visibility;
    protected $name;
    protected $description;

    public function getId()
    {
        return $this->id;
    }

    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setParent(EventInterface $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function addChild(EventInterface $child)
    {
        $this->children[] = $child;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function addRecurrenceSchedule(RecurrenceScheduleInterface $recurrence_schedule)
    {
        $this->recurrence_schedules[] = $recurrence_schedule;
    }

    public function getRecurrenceSchedules()
    {
        return $this->recurrence_schedules;
    }

    public function setCalendar(CalendarInterface $calendar)
    {
        $this->calendar = $calendar;
    }

    public function getCalendar()
    {
        return $this->calendar;
    }

    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function addParticipant(ParticipantInterface $participant)
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

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isPublic()
    {
        return EventInterface::VISIBILITY_PUBLIC === $this->visibility;
    }

    public function isPrivate()
    {
        return EventInterface::VISIBILITY_PRIVATE === $this->visibility;
    }

    public function isHidden()
    {
        return EventInterface::VISIBILITY_HIDDEN === $this->visibility;
    }

}
