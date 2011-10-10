<?php

namespace Lime\CalendarBundle\Model;

abstract class ParticipantManager implements ParticipantManagerInterface
{

    /**
     * @param EventInterface $event
     * @return ParticipantInterface
     */
    public function createParticipant(EventInterface $event)
    {
        $class = $this->getClass();
        $participant = new $class();

        $participant->setEvent($event);

        return $participant;
    }

}
