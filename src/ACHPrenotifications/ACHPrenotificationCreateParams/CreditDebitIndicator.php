<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotificationCreateParams;

/**
 * Whether the Prenotification is for a future debit or credit.
 */
enum CreditDebitIndicator: string
{
    case CREDIT = 'credit';

    case DEBIT = 'debit';
}
