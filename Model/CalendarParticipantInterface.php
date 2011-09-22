<?php

namespace Lime\CalendarBundle\Model;

interface CalendarParticipantInterface extends ParticipantInterface
{

    function setCalendar(CalendarInterface $calendar);

    function getCalendar();
}
