<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\CalendarManager as BaseCalendarManager;
use Doctrine\ORM\EntityManager;
use Lime\CalendarBundle\Model\EventInterface;
use Lime\CalendarBundle\Model\CalendarInterface;

class CalendarManager extends BaseCalendarManager
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

    public function addEvent(EventInterface $event, CalendarInterface $calendar)
    {
        $event->setCalendar($calendar);

        $this->em->persist($event);
        $this->em->flush();
    }

    public function getClass()
    {
        return $this->class;
    }

}
