<?php

namespace Lime\CalendarBundle\Model;

interface RecurrenceScheduleInterface
{

    function getId();

    function getCreatedAt();

    function getUpdatedAt();

    function setStart(\DateTime $start);

    function getStart();

    function setEvent(EventInterface $event);

    function getEvent();

    function setRecurrenceInterval(\DateInterval $recurrence_interval);

    function getRecurrenceInterval();

    /**
     * Sets the last time this event recurred
     *
     * @param \DateTime $last_recurrence
     */
    function setLastRecurrence(\DateTime $last_recurrence);

    /**
     * @return \DateTime the last time this event recurred
     */
    function getLastRecurrence();

    function setRecurUntil(\DateTime $recur_until);

    function getRecurUntil();

    function getRecurrences($fromLast = true, $excludeStart = true);

}
