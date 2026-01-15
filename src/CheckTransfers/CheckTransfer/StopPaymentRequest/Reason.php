<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\StopPaymentRequest;

/**
 * The reason why this transfer was stopped.
 */
enum Reason: string
{
    case MAIL_DELIVERY_FAILED = 'mail_delivery_failed';

    case REJECTED_BY_INCREASE = 'rejected_by_increase';

    case NOT_AUTHORIZED = 'not_authorized';

    case VALID_UNTIL_DATE_PASSED = 'valid_until_date_passed';

    case UNKNOWN = 'unknown';
}
