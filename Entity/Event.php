<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\Event as BaseEvent;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class Event extends BaseEvent
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
    protected $start_date;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $end_date;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $visibility;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->recurrence_schedules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
