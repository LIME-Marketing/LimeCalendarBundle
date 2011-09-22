<?php

namespace Lime\CalendarBundle\Model;

interface EventParticipantInterface extends ParticipantInterface
{

    function setEvent(EventInterface $event);

    function getEvent();
}
