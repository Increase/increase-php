<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

/**
 * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
 */
enum Category: string
{
    case ACCOUNT_TRANSFER_INSTRUCTION = 'account_transfer_instruction';

    case ACH_TRANSFER_INSTRUCTION = 'ach_transfer_instruction';

    case CARD_AUTHORIZATION = 'card_authorization';

    case CHECK_DEPOSIT_INSTRUCTION = 'check_deposit_instruction';

    case CHECK_TRANSFER_INSTRUCTION = 'check_transfer_instruction';

    case FEDNOW_TRANSFER_INSTRUCTION = 'fednow_transfer_instruction';

    case INBOUND_FUNDS_HOLD = 'inbound_funds_hold';

    case USER_INITIATED_HOLD = 'user_initiated_hold';

    case REAL_TIME_PAYMENTS_TRANSFER_INSTRUCTION = 'real_time_payments_transfer_instruction';

    case WIRE_TRANSFER_INSTRUCTION = 'wire_transfer_instruction';

    case INBOUND_WIRE_TRANSFER_REVERSAL = 'inbound_wire_transfer_reversal';

    case SWIFT_TRANSFER_INSTRUCTION = 'swift_transfer_instruction';

    case CARD_PUSH_TRANSFER_INSTRUCTION = 'card_push_transfer_instruction';

    case BLOCKCHAIN_ONRAMP_TRANSFER_INSTRUCTION = 'blockchain_onramp_transfer_instruction';

    case BLOCKCHAIN_OFFRAMP_TRANSFER_INTENTION = 'blockchain_offramp_transfer_intention';

    case OTHER = 'other';
}
