<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class Participant implements ParticipantInterface
{

    protected $id;
    protected $created_at;
    protected $updated_at;
    protected $expiry;
    protected $user;
    protected $role;

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

    public function setExpiry(\DateTime $expiry = null)
    {
        $this->expiry = $expiry;
    }
    
    public function getExpiry()
    {
        return $this->expiry;
    }

    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

}
