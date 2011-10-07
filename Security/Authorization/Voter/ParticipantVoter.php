<?php

namespace Lime\CalendarBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Lime\CalendarBundle\Model\EventInterface;

class ParticipantVoter extends BaseUserVoter
{

    /**
     * @param TokenInterface $token
     * @param EventInterface $object
     * @param array $attributes
     * @return integer voter decision
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $result = VoterInterface::ACCESS_ABSTAIN;

        return $result;
    }

}
