<?php

namespace Lime\CalendarBundle\Model;

interface CalendarManagerInterface
{

    /**
     * Concrete manager should handle flushing the relationship to the database
     *
     * @param EventInterface $event
     * @param CalendarInterface $calendar
     */
    function addEvent(EventInterface $event, CalendarInterface $calendar);

    /**
     * @param integer $id
     * @return CalendarInterface
     */
    function find($id);

    /**
     * @return string concrete Calendar class
     */
    function getClass();

}
