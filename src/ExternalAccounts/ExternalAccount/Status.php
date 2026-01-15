<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts\ExternalAccount;

/**
 * The External Account's status.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case ARCHIVED = 'archived';
}
