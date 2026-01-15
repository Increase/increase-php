<?php

declare(strict_types=1);

namespace Increase\AccountStatements\AccountStatement;

/**
 * A constant representing the object's type. For this resource it will always be `account_statement`.
 */
enum Type: string
{
    case ACCOUNT_STATEMENT = 'account_statement';
}
