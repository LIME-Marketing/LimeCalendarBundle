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
     * @return string concrete Calendar class
     */
    function getClass();

}
