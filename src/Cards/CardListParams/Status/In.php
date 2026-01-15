<?php

declare(strict_types=1);

namespace Increase\Cards\CardListParams\Status;

enum In: string
{
    case ACTIVE = 'active';

    case DISABLED = 'disabled';

    case CANCELED = 'canceled';
}
