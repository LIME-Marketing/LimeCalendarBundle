<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class Calendar implements CalendarInterface
{

    protected $id;
    protected $created_at;
    protected $updated_at;
    protected $user;
    protected $memberships = array();
    protected $events = array();
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

    public function setUser(UserInterface $user)
    {
        $this->user = $user;;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function addMembership(MembershipInterface $membership)
    {
        $this->memberships[] = $membership;
    }

    public function getMemberships()
    {
        return $this->memberships;
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

}
