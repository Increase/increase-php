<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotification;

/**
 * A constant representing the object's type. For this resource it will always be `ach_prenotification`.
 */
enum Type: string
{
    case ACH_PRENOTIFICATION = 'ach_prenotification';
}
