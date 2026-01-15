<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotification;

/**
 * If the notification is for a future credit or debit.
 */
enum CreditDebitIndicator: string
{
    case CREDIT = 'credit';

    case DEBIT = 'debit';
}
