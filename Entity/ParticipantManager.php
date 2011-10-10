<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\ParticipantManager as BaseParticipantManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Lime\CalendarBundle\Blamer\BlamerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Model\EventInterface;

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

        $result = $qb->getQuery()->getSingleResult();

        return $result;
    }

}
