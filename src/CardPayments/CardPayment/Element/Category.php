<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

/**
 * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
 */
enum Category: string
{
    case CARD_AUTHORIZATION = 'card_authorization';

    case CARD_AUTHENTICATION = 'card_authentication';

    case CARD_BALANCE_INQUIRY = 'card_balance_inquiry';

    case CARD_VALIDATION = 'card_validation';

    case CARD_DECLINE = 'card_decline';

    case CARD_REVERSAL = 'card_reversal';

    case CARD_AUTHORIZATION_EXPIRATION = 'card_authorization_expiration';

    case CARD_INCREMENT = 'card_increment';

    case CARD_SETTLEMENT = 'card_settlement';

    case CARD_REFUND = 'card_refund';

    case CARD_FUEL_CONFIRMATION = 'card_fuel_confirmation';

    case CARD_FINANCIAL = 'card_financial';

    case OTHER = 'other';
}
