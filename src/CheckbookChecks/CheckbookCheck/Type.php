<?php

declare(strict_types=1);

namespace Increase\CheckbookChecks\CheckbookCheck;

/**
 * A constant representing the object's type. For this resource it will always be `checkbook_check`.
 */
enum Type: string
{
    case CHECKBOOK_CHECK = 'checkbook_check';
}
