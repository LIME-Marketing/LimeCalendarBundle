<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\EventManager as BaseEventManager;
use Doctrine\ORM\EntityManager;
use Lime\CalendarBundle\Model\EventInterface;
use Lime\CalendarBundle\Model\RecurrenceScheduleInterface;
use Lime\CalendarBundle\Blamer\BlamerInterface;

class EventManager extends BaseEventManager
{

    protected $em;
    protected $repo;
    protected $class;
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

    public function findAll()
    {
        return $this->repo->findAll();
    }

    public function addEvent(EventInterface $event)
    {
        $this->blamer->blame($event);
        $event->setCreatedAt(new \DateTime());
        $event->setUpdatedAt(new \DateTime());
        $this->em->persist($event);
        $this->em->flush();

        return true;
    }

    public function updateEvent(EventInterface $event)
    {
        $event->setUpdatedAt(new \DateTime());
        $this->em->persist($event);
        $this->em->flush();

        return true;
    }

    public function removeEvent(EventInterface $event)
    {
        $this->em->remove($event);
        $this->em->flush();

        return true;
    }

    public function addRecurrenceSchedule(RecurrenceScheduleInterface $schedule, EventInterface $event)
    {
        $schedule->setEvent($event);

        $this->em->persist($schedule);
        $this->em->flush();
    }

    public function getClass()
    {
        return $this->class;
    }

}
