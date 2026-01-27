<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\InternalSource;

/**
 * An Internal Source is a transaction between you and Increase. This describes the reason for the transaction.
 */
enum Reason: string
{
    case ACCOUNT_CLOSURE = 'account_closure';

    case ACCOUNT_REVENUE_PAYMENT_DISTRIBUTION = 'account_revenue_payment_distribution';

    case BANK_DRAWN_CHECK = 'bank_drawn_check';

    case BANK_DRAWN_CHECK_CREDIT = 'bank_drawn_check_credit';

    case BANK_MIGRATION = 'bank_migration';

    case CHECK_ADJUSTMENT = 'check_adjustment';

    case COLLECTION_PAYMENT = 'collection_payment';

    case COLLECTION_RECEIVABLE = 'collection_receivable';

    case DISHONORED_ACH_RETURN = 'dishonored_ach_return';

    case EMPYREAL_ADJUSTMENT = 'empyreal_adjustment';

    case ERROR = 'error';

    case ERROR_CORRECTION = 'error_correction';

    case FEES = 'fees';

    case GENERAL_LEDGER_TRANSFER = 'general_ledger_transfer';

    case INTEREST = 'interest';

    case NEGATIVE_BALANCE_FORGIVENESS = 'negative_balance_forgiveness';

    case SAMPLE_FUNDS = 'sample_funds';

    case SAMPLE_FUNDS_RETURN = 'sample_funds_return';
}
