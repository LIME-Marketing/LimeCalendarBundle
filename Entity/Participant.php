<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\Participant as BaseParticipant;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class Participant extends BaseParticipant
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
    protected $expiry;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $role;

}
