<?php

namespace Lime\CalendarBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class BaseUserVoter implements VoterInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var EntityRepository
     */
    protected $repo;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repo = $em->getRepository($class);
        $this->class = $class;
    }

    public function supportsAttribute($attribute)
    {
        return in_array(strtolower($attribute), array(
            'create',
            'edit',
            'view',
            'delete',
        ));
    }

    public function supportsClass($class)
    {
        return $class === $this->class;
    }

}
