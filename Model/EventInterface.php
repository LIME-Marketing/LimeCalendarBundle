<?php

namespace Lime\CalendarBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Lime\CalendarBundle\Blamer\BlamableInterface;

interface EventInterface extends BlamableInterface
{

    const VISIBILITY_HIDDEN = 1;
    const VISIBILITY_PRIVATE = 2;
    const VISIBILITY_PUBLIC = 4;

    function getId();

    function setCreatedAt(\DateTime $created_at);

    function getCreatedAt();

    function setUpdatedAt(\DateTime $updated_at);

    function getUpdatedAt();

    function setParent(EventInterface $parent = null);

    function getParent();

    function addChild(EventInterface $child);

    function getChildren();

    function addRecurrenceSchedule(RecurrenceScheduleInterface $recurrence_schedule);

    function getRecurrenceSchedules();

    function setCalendar(CalendarInterface $calendar);

    function getCalendar();

    function addParticipant(ParticipantInterface $participant);

    function getParticipants();

    function setStartDate(\DateTime $start_date);

    function getStartDate();

    function setEndDate(\DateTime $end_date);

    function getEndDate();

    function getLength();

    function setVisibility($visibility);

    function getVisibility();

    function setName($name);

    function getName();

    function setDescription($description);

    function getDescription();

    function isPublic();

    function isPrivate();

    function isHidden();

}
