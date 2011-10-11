<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\MembershipManager as BaseMembershipManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Doctrine\ORM\EntityRepository;
use Lime\CalendarBundle\Blamer\BlamerInterface;
use Doctrine\ORM\NoResultException;

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

    /**
     * @var BlamerInterface
     */
    protected $blamer;

    public function __construct(EntityManager $em, $class, BlamerInterface $blamer)
    {
        $this->em = $em;
        $this->repo = $em->getRepository($class);
        $this->class = $class;
        $this->blamer = $blamer;
    }

    public function find($id)
    {
        return $this->repo->find($id);
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
