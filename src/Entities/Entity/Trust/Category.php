<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Trust;

/**
 * Whether the trust is `revocable` or `irrevocable`.
 */
enum Category: string
{
    case REVOCABLE = 'revocable';

    case IRREVOCABLE = 'irrevocable';
}
