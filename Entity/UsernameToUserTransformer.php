<?php

namespace Lime\CalendarBundle\Entity;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class UsernameToUserTransformer implements DataTransformerInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repo;

    /**
     * @var string
     */
    protected $class;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repo = $em->getRepository($class);
        $this->class = $class;
    }

    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof UserInterface) {
            throw new UnexpectedTypeException($value, 'Symfony\Component\Security\Core\User\UserInterface');
        }

        return $value->getUsername();
    }

    public function reverseTransform($value)
    {
        if ('' === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        return $this->repo->findOneByUsername($value);
    }

}
