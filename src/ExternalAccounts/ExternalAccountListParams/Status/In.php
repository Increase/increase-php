<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts\ExternalAccountListParams\Status;

enum In: string
{
    case ACTIVE = 'active';

    case ARCHIVED = 'archived';
}
