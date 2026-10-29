<?php

declare(strict_types=1);

namespace Increase\Simulations\WireDrawdownRequests\WireDrawdownRequestRefuseParams;

/**
 * The reason code that the simulated refusal will have.
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
