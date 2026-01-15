<?php

declare(strict_types=1);

namespace Increase\Accounts\AccountListParams\Status;

enum In: string
{
    case CLOSED = 'closed';

    case OPEN = 'open';
}
