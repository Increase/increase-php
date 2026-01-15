<?php

declare(strict_types=1);

namespace Increase\OAuthConnections\OAuthConnectionListParams\Status;

enum In: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
