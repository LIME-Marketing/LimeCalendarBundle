<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\EventManager as BaseEventManager;
use Doctrine\ORM\EntityManager;
use Lime\CalendarBundle\Model\EventParticipantInterface;
use Lime\CalendarBundle\Model\EventInterface;

class EventManager extends BaseEventManager
{

    protected $em;
    protected $repo;
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

    public function addParticipant(EventParticipantInterface $participant, EventInterface $event)
    {
        $participant->setEvent($event);

        $this->em->persist($participant);
        $this->em->flush();
    }

    public function getClass()
    {
        return $this->class;
    }

}
