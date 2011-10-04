<?php

namespace Lime\CalendarBundle\Model;

interface EventManagerInterface
{

    function addEvent(EventInterface $event);

    function createEvent(CalendarInterface $calendar);

    /**
     * @param integer $id
     * @return EventInterface
     */
    function find($id);

    /**
     * @return string concrete Event class
     */
    function getClass();

}
