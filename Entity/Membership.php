<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\Membership as BaseMembership;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class Membership extends BaseMembership
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
     * @ORM\Column(type="string")
     */
    protected $role;

}
