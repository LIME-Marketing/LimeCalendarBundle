<?php

namespace Lime\CalendarBundle\Model;

interface RecurringEventInterface extends EventInterface
{
    
    function setRecurrenceInterval(\DateInterval $recurrence_interval);

    function getRecurrenceInterval();

    function setLastRecurrence(\DateTime $last_recurrence);

    function getLastRecurrence();

    function setRecurUntil(\DateTime $recur_until);

    function getRecurUntil();

    function getRecurrences($fromlast = true);

}
