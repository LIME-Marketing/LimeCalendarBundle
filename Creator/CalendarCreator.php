<?php

namespace Lime\CalendarBundle\Creator;

use Lime\CalendarBundle\Model\CalendarManagerInterface;
use Lime\CalendarBundle\Model\CalendarInterface;
use Lime\CalendarBundle\Blamer\BlamerInterface;

class CalendarCreator implements CalendarCreatorInterface
{

    protected $manager;
    protected $blamer;

    public function __construct(CalendarManagerInterface $manager, BlamerInterface $blamer)
    {
        $this->manager  = $manager;
        $this->blamer   = $blamer;
    }

    public function create(CalendarInterface $calendar)
    {
        $this->blamer->blame($calendar);
        $this->manager->addCalendar($calendar);

        return true;
    }

}
