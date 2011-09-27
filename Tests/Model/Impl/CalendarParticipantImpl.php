<?php

namespace Lime\CalendarBundle\Tests\Model\Impl;

use Lime\CalendarBundle\Model\Participant;
use Lime\CalendarBundle\Model\CalendarParticipantInterface;
use Lime\CalendarBundle\Model\CalendarInterface;

class CalendarParticipantImpl extends Participant implements CalendarParticipantInterface
{
    
    protected $calendar;
    
    public function getCalendar()
    {
        return $this->calendar;
    }
    
    public function setCalendar(CalendarInterface $calendar)
    {
        $this->calendar = $calendar;
    }

}
