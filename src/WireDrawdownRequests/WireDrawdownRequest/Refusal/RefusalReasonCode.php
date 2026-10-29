<?php

declare(strict_types=1);

namespace Increase\WireDrawdownRequests\WireDrawdownRequest\Refusal;

/**
 * The reason the wire drawdown request was refused as provided by the debtor bank.
 */
enum RefusalReasonCode: string
{
    case INVALID_DEBTOR_ACCOUNT_NUMBER = 'invalid_debtor_account_number';

    case TRANSACTION_FORBIDDEN = 'transaction_forbidden';

    case UNSUCCESSFUL_DIRECT_DEBIT = 'unsuccessful_direct_debit';

    case INCONSISTENT_WITH_END_CUSTOMER = 'inconsistent_with_end_customer';

    case NARRATIVE = 'narrative';

    case OTHER = 'other';
}
