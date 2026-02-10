<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

/**
 * The type of Export to create.
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

    case ACCOUNT_VERIFICATION_LETTER = 'account_verification_letter';

    case FUNDING_INSTRUCTIONS = 'funding_instructions';

    case VOIDED_CHECK = 'voided_check';
}
