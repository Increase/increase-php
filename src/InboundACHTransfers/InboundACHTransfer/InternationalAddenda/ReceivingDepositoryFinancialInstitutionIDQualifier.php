<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda;

/**
 * An instruction of how to interpret the `receiving_depository_financial_institution_id` field for this Transaction.
 */
enum ReceivingDepositoryFinancialInstitutionIDQualifier: string
{
    case NATIONAL_CLEARING_SYSTEM_NUMBER = 'national_clearing_system_number';

    case BIC_CODE = 'bic_code';

    case IBAN = 'iban';
}
