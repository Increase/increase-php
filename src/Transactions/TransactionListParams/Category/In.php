<?php

declare(strict_types=1);

namespace Increase\Transactions\TransactionListParams\Category;

enum In: string
{
    case ACCOUNT_TRANSFER_INTENTION = 'account_transfer_intention';

    case ACH_TRANSFER_INTENTION = 'ach_transfer_intention';

    case ACH_TRANSFER_REJECTION = 'ach_transfer_rejection';

    case ACH_TRANSFER_RETURN = 'ach_transfer_return';

    case CASHBACK_PAYMENT = 'cashback_payment';

    case CARD_DISPUTE_ACCEPTANCE = 'card_dispute_acceptance';

    case CARD_DISPUTE_FINANCIAL = 'card_dispute_financial';

    case CARD_DISPUTE_LOSS = 'card_dispute_loss';

    case CARD_REFUND = 'card_refund';

    case CARD_SETTLEMENT = 'card_settlement';

    case CARD_FINANCIAL = 'card_financial';

    case CARD_REVENUE_PAYMENT = 'card_revenue_payment';

    case CHECK_DEPOSIT_ACCEPTANCE = 'check_deposit_acceptance';

    case CHECK_DEPOSIT_RETURN = 'check_deposit_return';

    case FEDNOW_TRANSFER_ACKNOWLEDGEMENT = 'fednow_transfer_acknowledgement';

    case CHECK_TRANSFER_DEPOSIT = 'check_transfer_deposit';

    case FEE_PAYMENT = 'fee_payment';

    case INBOUND_ACH_TRANSFER = 'inbound_ach_transfer';

    case INBOUND_ACH_TRANSFER_RETURN_INTENTION = 'inbound_ach_transfer_return_intention';

    case INBOUND_CHECK_DEPOSIT_RETURN_INTENTION = 'inbound_check_deposit_return_intention';

    case INBOUND_CHECK_ADJUSTMENT = 'inbound_check_adjustment';

    case INBOUND_FEDNOW_TRANSFER_CONFIRMATION = 'inbound_fednow_transfer_confirmation';

    case INBOUND_REAL_TIME_PAYMENTS_TRANSFER_CONFIRMATION = 'inbound_real_time_payments_transfer_confirmation';

    case INBOUND_WIRE_REVERSAL = 'inbound_wire_reversal';

    case INBOUND_WIRE_TRANSFER = 'inbound_wire_transfer';

    case INBOUND_WIRE_TRANSFER_REVERSAL = 'inbound_wire_transfer_reversal';

    case INTEREST_PAYMENT = 'interest_payment';

    case INTERNAL_SOURCE = 'internal_source';

    case REAL_TIME_PAYMENTS_TRANSFER_ACKNOWLEDGEMENT = 'real_time_payments_transfer_acknowledgement';

    case SAMPLE_FUNDS = 'sample_funds';

    case WIRE_TRANSFER_INTENTION = 'wire_transfer_intention';

    case SWIFT_TRANSFER_INTENTION = 'swift_transfer_intention';

    case SWIFT_TRANSFER_RETURN = 'swift_transfer_return';

    case CARD_PUSH_TRANSFER_ACCEPTANCE = 'card_push_transfer_acceptance';

    case ACCOUNT_REVENUE_PAYMENT = 'account_revenue_payment';

    case BLOCKCHAIN_ONRAMP_TRANSFER_INTENTION = 'blockchain_onramp_transfer_intention';

    case BLOCKCHAIN_OFFRAMP_TRANSFER_SETTLEMENT = 'blockchain_offramp_transfer_settlement';

    case OTHER = 'other';
}
