<?php

namespace Lime\CalendarBundle\Model;

abstract class RecurringEvent extends Event implements RecurringEventInterface
{

    protected $recurrence_interval;
    protected $last_recurrence;
    protected $recur_until;

    public function setRecurrenceInterval(\DateInterval $recurrence_interval)
    {
        $this->recurrence_interval = $recurrence_interval;
    }

    public function getRecurrenceInterval()
    {
        return $this->recurrence_interval;
    }

    public function setLastRecurrence(\DateTime $last_recurrence)
    {
        $this->last_recurrence = $last_recurrence;
    }

    public function getLastRecurrence()
    {
        return $this->last_recurrence;
    }

    public function setRecurUntil(\DateTime $recur_until)
    {
        $this->recur_until = $recur_until;
    }

    public function getRecurUntil()
    {
        return $this->recur_until;
    }

    public function getRecurrences($fromLast = true, $excludeStart = true)
    {
        if ($fromLast) {
            $start = $this->last_recurrence;
        } else {
            $start = $this->start;
        }
        
        return new \DatePeriod($start, $this->recurrence_interval, $this->recur_until, $excludeStart ? \DatePeriod::EXCLUDE_START_DATE : null);
    }

}
