<?php

namespace Lime\CalendarBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\NoResultException;
use Lime\CalendarBundle\Model\MembershipInterface;

class MemberVoter extends BaseUserVoter
{

    /**
     * @param TokenInterface $token
     * @param CalendarInterface $object
     * @param array $attributes
     * @return integer voter decision
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $result = VoterInterface::ACCESS_ABSTAIN;

        if ($this->supportsClass(get_class($object))) {

            $permissionMap = array(
                MembershipInterface::ROLE_OWNER => array(
                    'delete',
                    'edit',
                    'create',
                    'view',
                ),
                MembershipInterface::ROLE_ADMIN => array(
                    'edit',
                    'create',
                    'view',
                ),
                MembershipInterface::ROLE_CONTRIBUTE => array(
                    'create',
                    'view',
                ),
                MembershipInterface::ROLE_VIEW => array(
                    'view',
                ),
            );

            foreach ($attributes as $attribute) {
                if (!$this->supportsAttribute($attribute)) {
                    continue;
                }

                if ($membership = $this->getMembership($token->getUser(), $object)) {

                } else {
                    $result = VoterInterface::ACCESS_DENIED;
                }
            }
        }

        return $result;
    }

    /**
     *
     * @param $user
     * @param CalendarInterface $object
     * @return MembershipInterface|null
     */
    protected function getMembership($user, CalendarInterface $object)
    {
        $qb = $this->repo->createQueryBuilder('c');
        $qb->select('m, c')
            ->join('c.memberships', 'm')
            ->andWhere('c = :calendar')
            ->andWhere('m.user = :user');
        $qb->setParameters(array(
            'calendar' => $object,
            'user' => $user,
        ));

        try {
            $calendar = $qb->getQuery()->getSingleResult();
        } catch (NoResultException $ex) {
            return null;
        }

        $membership = $calendar->getMemberships()->first();

        return $membership;
    }

}
