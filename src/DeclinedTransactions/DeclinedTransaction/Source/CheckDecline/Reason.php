<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source\CheckDecline;

/**
 * Why the check was declined.
 */
enum Reason: string
{
    case ACH_ROUTE_DISABLED = 'ach_route_disabled';

    case ACH_ROUTE_CANCELED = 'ach_route_canceled';

    case ALTERED_OR_FICTITIOUS = 'altered_or_fictitious';

    case BREACHES_LIMIT = 'breaches_limit';

    case ENDORSEMENT_IRREGULAR = 'endorsement_irregular';

    case ENTITY_NOT_ACTIVE = 'entity_not_active';

    case GROUP_LOCKED = 'group_locked';

    case INSUFFICIENT_FUNDS = 'insufficient_funds';

    case STOP_PAYMENT_REQUESTED = 'stop_payment_requested';

    case DUPLICATE_PRESENTMENT = 'duplicate_presentment';

    case NOT_AUTHORIZED = 'not_authorized';

    case AMOUNT_MISMATCH = 'amount_mismatch';

    case NOT_OUR_ITEM = 'not_our_item';

    case NO_ACCOUNT_NUMBER_FOUND = 'no_account_number_found';

    case REFER_TO_IMAGE = 'refer_to_image';

    case UNABLE_TO_PROCESS = 'unable_to_process';

    case UNUSABLE_IMAGE = 'unusable_image';

    case USER_INITIATED = 'user_initiated';
}
