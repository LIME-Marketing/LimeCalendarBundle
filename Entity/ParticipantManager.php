<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\ParticipantManager as BaseParticipantManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Lime\CalendarBundle\Blamer\BlamerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\EventInterface;
use Doctrine\ORM\NoResultException;

class ParticipantManager extends BaseParticipantManager
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repo;

    /**
     * @var string
     */
    protected $class;

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

    public function getParticipant(UserInterface $user, EventInterface $event)
    {
        $qb = $this->repo->createQueryBuilder('p');
        $qb
            ->andWhere('p.user = :user')
            ->andWhere('p.event = :event');
        $qb->setParameters(array(
            'user' => $user,
            'event' => $event,
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
