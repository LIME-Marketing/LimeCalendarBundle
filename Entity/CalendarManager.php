<?php

namespace Lime\CalendarBundle\Entity;

use Lime\CalendarBundle\Model\CalendarManager as BaseCalendarManager;
use Doctrine\ORM\EntityManager;
use Lime\CalendarBundle\Model\CalendarInterface;
use Lime\CalendarBundle\Blamer\BlamerInterface;
use Lime\CalendarBundle\Model\MembershipManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CalendarManager extends BaseCalendarManager
{

    protected $membershipManager;
    protected $em;
    protected $repo;
    protected $class;
    protected $blamer;

    public function __construct(MembershipManagerInterface $membershipManager, EntityManager $em, $class, BlamerInterface $blamer)
    {
        $this->em = $em;
        $this->repo = $em->getRepository($class);
        $this->class = $class;
        $this->blamer = $blamer;
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function findAll()
    {
        return $this->repo->findAll();
    }

    public function addCalendar(CalendarInterface $calendar)
    {
        $this->blamer->blame($calendar);
        $calendar->setCreatedAt(new \DateTime());
        $calendar->setUpdatedAt(new \DateTime());
        $this->em->persist($calendar);
        $this->em->flush();

        return true;
    }

    public function updateCalendar(CalendarInterface $calendar)
    {
        $calendar->setUpdatedAt(new \DateTime());
        $this->em->persist($calendar);
        $this->em->flush();

        return true;
    }

    public function removeCalendar(CalendarInterface $calendar)
    {
        $this->em->remove($calendar);
        $this->em->flush();

        return true;
    }

    public function hasRole($role, UserInterface $user, CalendarInterface $calendar)
    {
        $membership = $this->membershipManager->getMembership($user, $calendar);
        if (is_array($role)) {
            return in_array($membership->getRole(), $role, true);
        }

        return $membership->getRole() === $role;
    }

    public function isMember(UserInterface $user, CalendarInterface $calendar)
    {
        return null !== $this->membershipManager->getMembership($user, $calendar);
    }

    public function getClass()
    {
        return $this->class;
    }

}
