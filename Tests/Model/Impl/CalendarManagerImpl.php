<?php

namespace Lime\CalendarBundle\Tests\Model\Impl;

use Lime\CalendarBundle\Model\CalendarManager;
use Lime\CalendarBundle\Model\EventInterface;
use Lime\CalendarBundle\Model\CalendarInterface;

class CalendarManagerImpl extends CalendarManager
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

    public function addEvent(EventInterface $event, CalendarInterface $calendar) {}

    public function find($id) {}

}
