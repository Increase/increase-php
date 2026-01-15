<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\Submission;

/**
 * Per USPS requirements, Increase will standardize the address to USPS standards and check it against the USPS National Change of Address (NCOA) database before mailing it. This indicates what modifications, if any, were made to the address before printing and mailing the check.
 */
enum AddressCorrectionAction: string
{
    case NONE = 'none';

    case STANDARDIZATION = 'standardization';

    case STANDARDIZATION_WITH_ADDRESS_CHANGE = 'standardization_with_address_change';

    case ERROR = 'error';
}
