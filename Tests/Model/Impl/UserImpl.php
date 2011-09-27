<?php

namespace Lime\CalendarBundle\Tests\Model\Impl;

use Symfony\Component\Security\Core\User\UserInterface;

class UserImpl implements UserInterface
{

    protected $id;
    protected $username;
    protected $roles = array();

    public function __construct($id, $username, $roles = array('ROLE_USER'))
    {
        $this->id = $id;
        $this->username = $username;
        $this->roles = $roles;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getRoles()
    {
        return $roles;
    }

    public function getPassword() {}

    public function getSalt() {}

    public function equals(UserInterface $user) {}

    public function eraseCredentials(){}
    
}
