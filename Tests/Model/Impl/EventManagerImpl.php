<?php

namespace Lime\CalendarBundle\Tests\Model\Impl;

use Lime\CalendarBundle\Model\EventManager;
use Lime\CalendarBundle\Model\EventParticipantInterface;
use Lime\CalendarBundle\Model\EventInterface;

class EventManagerImpl extends EventManager
{

    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function addParticipant(EventParticipantInterface $participant, EventInterface $event) {}

    public function find($id) {}

}
