<?php

namespace Lime\CalendarBundle\Model;

interface CalendarManagerInterface
{

    function addCalendar(CalendarInterface $calendar);

    /**
     * @return CalendarInterface
     */
    function createCalendar();

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
