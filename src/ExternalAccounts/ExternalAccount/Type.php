<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts\ExternalAccount;

/**
 * A constant representing the object's type. For this resource it will always be `external_account`.
 */
enum Type: string
{
    case EXTERNAL_ACCOUNT = 'external_account';
}
