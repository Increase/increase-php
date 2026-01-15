<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices;

/**
 * Cardholder paid to have work redone.
 */
enum CardholderPaidToHaveWorkRedone: string
{
    case DID_NOT_PAY_TO_HAVE_WORK_REDONE = 'did_not_pay_to_have_work_redone';

    case PAID_TO_HAVE_WORK_REDONE = 'paid_to_have_work_redone';
}
