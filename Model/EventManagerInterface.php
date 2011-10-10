<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

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

    /**
     * @param mixed $role either a string role or array of roles
     * @param UserInterface $user
     * @param EventInterface $calendar
     * @return boolean whether user has (one of the) specified role on the event
     */
    function hasRole($role, UserInterface $user, EventInterface $event);

}
