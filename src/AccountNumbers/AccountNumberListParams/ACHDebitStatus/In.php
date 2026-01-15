<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberListParams\ACHDebitStatus;

enum In: string
{
    case ALLOWED = 'allowed';

    case BLOCKED = 'blocked';
}
