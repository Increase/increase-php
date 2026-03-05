<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication;

/**
 * The 3DS requestor authentication indicator describes why the authentication attempt is performed, such as for a recurring transaction.
 */
enum RequestorAuthenticationIndicator: string
{
    case PAYMENT_TRANSACTION = 'payment_transaction';

    case RECURRING_TRANSACTION = 'recurring_transaction';

    case INSTALLMENT_TRANSACTION = 'installment_transaction';

    case ADD_CARD = 'add_card';

    case MAINTAIN_CARD = 'maintain_card';

    case EMV_TOKEN_CARDHOLDER_VERIFICATION = 'emv_token_cardholder_verification';

    case BILLING_AGREEMENT = 'billing_agreement';
}
