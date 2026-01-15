<?php

declare(strict_types=1);

namespace Increase\AccountNumbers\AccountNumberListParams\Status;

enum In: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}
