<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts\ExternalAccountUpdateParams;

/**
 * The status of the External Account.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case ARCHIVED = 'archived';
}
