<?php

namespace Lime\CalendarBundle\Blamer;

use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityBlamer implements BlamerInterface
{

    protected $securityContext;

    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function blame(BlamableInterface $blamable)
    {
        if (null === $this->securityContext->getToken()) {
            throw new \RuntimeException('You must configure a firewall for this route.');
        }

        if ($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $blamable->setUser($this->securityContext->getToken()->getUser());
        }
    }

}
