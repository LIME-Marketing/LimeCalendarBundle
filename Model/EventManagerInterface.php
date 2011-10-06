<?php

namespace Lime\CalendarBundle\Model;

interface EventManagerInterface
{

    /**
     * @return boolean whether the event was added successfully
     */
    function addEvent(EventInterface $event);

    /**
     * @return boolean whether the event was updated successfully
     */
    function updateEvent(EventInterface $event);

    function removeEvent(EventInterface $event);

    /**
     * @return EventInterface
     */
    function createEvent(CalendarInterface $calendar);

    /**
     * @param integer $id
     * @return EventInterface
     */
    function find($id);

    function findAll();

    /**
     * @return string concrete Event class
     */
    function getClass();

}
