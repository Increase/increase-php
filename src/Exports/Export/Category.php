<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

/**
 * The category of the Export. We may add additional possible values for this enum over time; your application should be able to handle that gracefully.
 */
enum Category: string
{
    case ACCOUNT_STATEMENT_OFX = 'account_statement_ofx';

    case ACCOUNT_STATEMENT_BAI2 = 'account_statement_bai2';

    case TRANSACTION_CSV = 'transaction_csv';

    case BALANCE_CSV = 'balance_csv';

    case BOOKKEEPING_ACCOUNT_BALANCE_CSV = 'bookkeeping_account_balance_csv';

    case ENTITY_CSV = 'entity_csv';

    case VENDOR_CSV = 'vendor_csv';

    case DASHBOARD_TABLE_CSV = 'dashboard_table_csv';

    case ACCOUNT_VERIFICATION_LETTER = 'account_verification_letter';

    case FUNDING_INSTRUCTIONS = 'funding_instructions';

    case FORM_1099_INT = 'form_1099_int';

    case FORM_1099_MISC = 'form_1099_misc';

    case FEE_CSV = 'fee_csv';

    case VOIDED_CHECK = 'voided_check';
}
