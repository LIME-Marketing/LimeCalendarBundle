<?php

namespace Lime\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lime\CalendarBundle\Model\RecurrenceSchedule as BaseRecurrenceSchedule;

/**
 * @ORM\MappedSuperclass
 */
abstract class RecurrenceSchedule extends BaseRecurrenceSchedule
{

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $start;

    /**
     * @ORM\Column(type="object")
     */
    protected $recurrence_interval;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_recurrence;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $recur_until;

}
