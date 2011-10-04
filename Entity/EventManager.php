<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\EventManager as BaseEventManager;
use Doctrine\ORM\EntityManager;
use Lime\CalendarBundle\Model\EventInterface;
use Lime\CalendarBundle\Model\RecurrenceScheduleInterface;

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

    public function addEvent(EventInterface $event)
    {
        $this->em->persist($event);
        $this->em->flush();
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
