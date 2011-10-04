<?php

namespace Lime\CalendarBundle\Blamer;

interface BlamerInterface
{

    function blame(BlamableInterface $blamable);

}
