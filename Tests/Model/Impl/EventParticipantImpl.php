<?php

namespace Lime\CalendarBundle\Tests\Model\Impl;

use Lime\CalendarBundle\Model\Participant;
use Lime\CalendarBundle\Model\EventParticipantInterface;
use Lime\CalendarBundle\Model\EventInterface;

class EventParticipantImpl extends Participant implements EventParticipantInterface
{
    
    protected $event;
    
    public function setEvent(EventInterface $event)
    {
        $this->event = $event;
    }
    
    public function getEvent()
    {
        return $this->event;
    }

}
