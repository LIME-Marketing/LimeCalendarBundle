<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\MembershipManager as BaseMembershipManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Doctrine\ORM\EntityRepository;
use Lime\CalendarBundle\Blamer\BlamerInterface;
use Doctrine\ORM\NoResultException;
use Lime\CalendarBundle\Model\MembershipInterface;

class MembershipManager extends BaseMembershipManager
{

    /**
     * @var string
     */
    protected $class;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repo;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repo = $em->getRepository($class);
        $this->class = $class;
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function addMembership(MembershipInterface $membership)
    {
        $membership->setCreatedAt(new \DateTime());
        $membership->setUpdatedAt(new \DateTime());
        $this->em->persist($membership);
        $this->em->flush();

        return true;
    }

    public function getMembership(UserInterface $user, CalendarInterface $calendar)
    {
        $qb = $this->repo->createQueryBuilder('m');
        $qb
            ->andWhere('m.user = :user')
            ->andWhere('m.calendar = :calendar');
        $qb->setParameters(array(
            'user' => $user,
            'calendar' => $calendar,
        ));

        try {
            $result = $qb->getQuery()->getSingleResult();
        } catch (NoResultException $ex) {
            $result = null;
        }

        return $result;
    }

    public function getClass()
    {
        return $this->class;
    }

}
