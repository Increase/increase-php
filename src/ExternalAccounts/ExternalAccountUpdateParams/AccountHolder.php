<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts\ExternalAccountUpdateParams;

/**
 * The type of entity that owns the External Account.
 */
enum AccountHolder: string
{
    case BUSINESS = 'business';

    case INDIVIDUAL = 'individual';
}
