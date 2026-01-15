<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication;

/**
 * The reason why this authentication attempt was denied, if it was.
 */
enum DenyReason: string
{
    case GROUP_LOCKED = 'group_locked';

    case CARD_NOT_ACTIVE = 'card_not_active';

    case ENTITY_NOT_ACTIVE = 'entity_not_active';

    case TRANSACTION_NOT_ALLOWED = 'transaction_not_allowed';

    case WEBHOOK_DENIED = 'webhook_denied';

    case WEBHOOK_TIMED_OUT = 'webhook_timed_out';
}
