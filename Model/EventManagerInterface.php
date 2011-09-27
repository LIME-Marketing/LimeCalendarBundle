<?php

namespace Lime\CalendarBundle\Model;

interface EventManagerInterface
{

    /**
     * Concrete manager should handle flushing the relationship to the database
     *
     * @param EventParticipantInterface $participant
     * @param EventInterface $event
     */
    function addParticipant(EventParticipantInterface $participant, EventInterface $event);

    /**
     * @param integer $id
     * @return EventInterface
     */
    function find($id);

    /**
     * @return string concrete Event class
     */
    function getClass();

}
