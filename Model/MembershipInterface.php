<?php

namespace Lime\CalendarBundle\Model;

use Lime\CalendarBundle\Blamer\BlamableInterface;

interface MembershipInterface extends BlamableInterface
{
    const ROLE_VIEW = 1;
    const ROLE_CONTRIBUTE = 2;
    const ROLE_ADMIN = 4;
}
