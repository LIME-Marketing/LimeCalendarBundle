<?php

namespace Lime\CalendarBundle\Creator;

use Lime\CalendarBundle\Model\EventManagerInterface;
use Lime\CalendarBundle\Blamer\BlamerInterface;
use Lime\CalendarBundle\Model\EventInterface;

class EventCreator implements EventCreatorInterface
{

    protected $manager;
    protected $blamer;

    public function __construct(EventManagerInterface $manager, BlamerInterface $blamer)
    {
        $this->manager  = $manager;
        $this->blamer   = $blamer;
    }

    public function create(EventInterface $event)
    {
        $this->blamer->blame($event);
        $this->manager->addEvent($event);

        return true;
    }

}
