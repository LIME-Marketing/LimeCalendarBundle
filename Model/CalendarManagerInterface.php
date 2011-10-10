<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface CalendarManagerInterface
{

    /**
     * @return boolean whether the calendar was added successfully
     */
    function addCalendar(CalendarInterface $calendar);

    /**
     * @return boolean whether the calendar was updated successfully
     */
    function updateCalendar(CalendarInterface $calendar);

    function removeCalendar(CalendarInterface $calendar);

    /**
     * @return CalendarInterface
     */
    function createCalendar();

    /**
     * @param integer $id
     * @return CalendarInterface
     */
    function find($id);

    function findAll();

    /**
     * @return string concrete Calendar class
     */
    function getClass();

    /**
     * @param mixed $role either a string role or array of roles
     * @param UserInterface $user
     * @param CalendarInterface $calendar
     * @return boolean whether user has (one of the) specified role on the calendar
     */
    function hasRole($role, UserInterface $user, CalendarInterface $calendar);

}
