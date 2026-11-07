<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberListParams\InboundACHDebits;

enum In: string
{
    case ALLOWED = 'allowed';

    case BLOCKED = 'blocked';
}
