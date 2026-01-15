<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\PaidByOtherMeans;

/**
 * Other form of payment evidence.
 */
enum OtherFormOfPaymentEvidence: string
{
    case CANCELED_CHECK = 'canceled_check';

    case CARD_TRANSACTION = 'card_transaction';

    case CASH_RECEIPT = 'cash_receipt';

    case OTHER = 'other';

    case STATEMENT = 'statement';

    case VOUCHER = 'voucher';
}
