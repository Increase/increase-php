<?php

declare(strict_types=1);

namespace Increase\IntrafiAccountEnrollments\IntrafiAccountEnrollment;

/**
 * A constant representing the object's type. For this resource it will always be `intrafi_account_enrollment`.
 */
enum Type: string
{
    case INTRAFI_ACCOUNT_ENROLLMENT = 'intrafi_account_enrollment';
}
