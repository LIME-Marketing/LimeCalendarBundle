<?php

namespace Lime\CalendarBundle\Model;

use Lime\CalendarBundle\Blamer\BlamableInterface;

interface MembershipInterface extends BlamableInterface
{
    const ROLE_OWNER        = 'owner';
    const ROLE_ADMIN        = 'admin';
    const ROLE_CONTRIBUTE   = 'contribute';
    const ROLE_VIEW         = 'view';
}
