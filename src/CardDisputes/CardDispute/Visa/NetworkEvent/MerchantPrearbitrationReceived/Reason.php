<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;

/**
 * The reason the merchant re-presented the dispute.
 */
enum Reason: string
{
    case CARDHOLDER_NO_LONGER_DISPUTES = 'cardholder_no_longer_disputes';

    case COMPELLING_EVIDENCE = 'compelling_evidence';

    case CREDIT_OR_REVERSAL_PROCESSED = 'credit_or_reversal_processed';

    case DELAYED_CHARGE_TRANSACTION = 'delayed_charge_transaction';

    case EVIDENCE_OF_IMPRINT = 'evidence_of_imprint';

    case INVALID_DISPUTE = 'invalid_dispute';

    case NON_FIAT_CURRENCY_OR_NON_FUNGIBLE_TOKEN_RECEIVED = 'non_fiat_currency_or_non_fungible_token_received';

    case PRIOR_UNDISPUTED_NON_FRAUD_TRANSACTIONS = 'prior_undisputed_non_fraud_transactions';
}
