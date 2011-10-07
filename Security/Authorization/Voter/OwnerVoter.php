<?php

namespace Lime\CalendarBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class OwnerVoter implements VoterInterface
{

    protected $classes = array();

    public function __construct(array $classes)
    {
        $this->classes = $classes;
    }

    public function supportsAttribute($attribute)
    {
        return true;
    }

    public function supportsClass($class)
    {
        return in_array($class, $this->classes);
    }

    public function vote(TokenInterface $token, $object, array $attributes)
    {
        if (!$this->supportsClass(get_class($object))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }
        
        return $token->getUser() === $object->getUser() ? VoterInterface::ACCESS_GRANTED : VoterInterface::ACCESS_DENIED;
    }

}
