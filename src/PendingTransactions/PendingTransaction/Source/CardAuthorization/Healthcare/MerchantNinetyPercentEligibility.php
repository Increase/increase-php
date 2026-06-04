<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source\CardAuthorization\Healthcare;

/**
 * The merchant's eligibility under the Internal Revenue Service's 90% Rule for Flexible Spending Account (FSA) and Health Savings Account (HSA) eligible products. The eligibility is determined based on the list of merchants maintained by the Special Interest Group for IIAS Standards (SIGIS).
 */
enum MerchantNinetyPercentEligibility: string
{
    case ELIGIBLE = 'eligible';

    case NOT_ELIGIBLE = 'not_eligible';
}
