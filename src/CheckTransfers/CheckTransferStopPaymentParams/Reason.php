<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferStopPaymentParams;

/**
 * The reason why this transfer should be stopped.
 */
enum Reason: string
{
    case MAIL_DELIVERY_FAILED = 'mail_delivery_failed';

    case NOT_AUTHORIZED = 'not_authorized';

    case VALID_UNTIL_DATE_PASSED = 'valid_until_date_passed';

    case UNKNOWN = 'unknown';
}
