<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\Represented;

/**
 * The reason the merchant re-presented the dispute.
 */
enum Reason: string
{
    case CARDHOLDER_NO_LONGER_DISPUTES = 'cardholder_no_longer_disputes';

    case CREDIT_OR_REVERSAL_PROCESSED = 'credit_or_reversal_processed';

    case INVALID_DISPUTE = 'invalid_dispute';

    case NON_FIAT_CURRENCY_OR_NON_FUNGIBLE_TOKEN_AS_DESCRIBED = 'non_fiat_currency_or_non_fungible_token_as_described';

    case NON_FIAT_CURRENCY_OR_NON_FUNGIBLE_TOKEN_RECEIVED = 'non_fiat_currency_or_non_fungible_token_received';

    case PROOF_OF_CASH_DISBURSEMENT = 'proof_of_cash_disbursement';

    case REVERSAL_ISSUED = 'reversal_issued';
}
