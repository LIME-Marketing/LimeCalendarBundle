<?php

namespace Lime\CalendarBundle\Security;

use Symfony\Component\Security\Core\SecurityContextInterface;

class UserProvider implements UserProviderInterface
{

    protected $securityContext;

    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function getUser()
    {
        if (null === $this->securityContext->getToken()) {
            return null;
        }

        return $this->securityContext->getToken()->getUser();
    }

}
