<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions\EventSubscriptionCreateParams;

/**
 * If specified, this subscription will only receive webhooks for Events with the specified `category`.
 */
enum SelectedEventCategory: string
{
    case ACCOUNT_CREATED = 'account.created';

    case ACCOUNT_UPDATED = 'account.updated';

    case ACCOUNT_NUMBER_CREATED = 'account_number.created';

    case ACCOUNT_NUMBER_UPDATED = 'account_number.updated';

    case ACCOUNT_STATEMENT_CREATED = 'account_statement.created';

    case ACCOUNT_TRANSFER_CREATED = 'account_transfer.created';

    case ACCOUNT_TRANSFER_UPDATED = 'account_transfer.updated';

    case ACH_PRENOTIFICATION_CREATED = 'ach_prenotification.created';

    case ACH_PRENOTIFICATION_UPDATED = 'ach_prenotification.updated';

    case ACH_TRANSFER_CREATED = 'ach_transfer.created';

    case ACH_TRANSFER_UPDATED = 'ach_transfer.updated';

    case BLOCKCHAIN_ADDRESS_CREATED = 'blockchain_address.created';

    case BLOCKCHAIN_ADDRESS_UPDATED = 'blockchain_address.updated';

    case BLOCKCHAIN_OFFRAMP_TRANSFER_CREATED = 'blockchain_offramp_transfer.created';

    case BLOCKCHAIN_OFFRAMP_TRANSFER_UPDATED = 'blockchain_offramp_transfer.updated';

    case BLOCKCHAIN_ONRAMP_TRANSFER_CREATED = 'blockchain_onramp_transfer.created';

    case BLOCKCHAIN_ONRAMP_TRANSFER_UPDATED = 'blockchain_onramp_transfer.updated';

    case BOOKKEEPING_ACCOUNT_CREATED = 'bookkeeping_account.created';

    case BOOKKEEPING_ACCOUNT_UPDATED = 'bookkeeping_account.updated';

    case BOOKKEEPING_ENTRY_SET_UPDATED = 'bookkeeping_entry_set.updated';

    case CARD_CREATED = 'card.created';

    case CARD_UPDATED = 'card.updated';

    case CARD_PAYMENT_CREATED = 'card_payment.created';

    case CARD_PAYMENT_UPDATED = 'card_payment.updated';

    case CARD_PROFILE_CREATED = 'card_profile.created';

    case CARD_PROFILE_UPDATED = 'card_profile.updated';

    case CARD_DISPUTE_CREATED = 'card_dispute.created';

    case CARD_DISPUTE_UPDATED = 'card_dispute.updated';

    case CHECK_DEPOSIT_CREATED = 'check_deposit.created';

    case CHECK_DEPOSIT_UPDATED = 'check_deposit.updated';

    case CHECK_TRANSFER_CREATED = 'check_transfer.created';

    case CHECK_TRANSFER_UPDATED = 'check_transfer.updated';

    case DECLINED_TRANSACTION_CREATED = 'declined_transaction.created';

    case DIGITAL_CARD_PROFILE_CREATED = 'digital_card_profile.created';

    case DIGITAL_CARD_PROFILE_UPDATED = 'digital_card_profile.updated';

    case DIGITAL_WALLET_TOKEN_CREATED = 'digital_wallet_token.created';

    case DIGITAL_WALLET_TOKEN_UPDATED = 'digital_wallet_token.updated';

    case DOCUMENT_CREATED = 'document.created';

    case ENTITY_CREATED = 'entity.created';

    case ENTITY_UPDATED = 'entity.updated';

    case EVENT_SUBSCRIPTION_CREATED = 'event_subscription.created';

    case EVENT_SUBSCRIPTION_UPDATED = 'event_subscription.updated';

    case EXPORT_CREATED = 'export.created';

    case EXPORT_UPDATED = 'export.updated';

    case EXTERNAL_ACCOUNT_CREATED = 'external_account.created';

    case EXTERNAL_ACCOUNT_UPDATED = 'external_account.updated';

    case FEDNOW_TRANSFER_CREATED = 'fednow_transfer.created';

    case FEDNOW_TRANSFER_UPDATED = 'fednow_transfer.updated';

    case FILE_CREATED = 'file.created';

    case GROUP_UPDATED = 'group.updated';

    case GROUP_HEARTBEAT = 'group.heartbeat';

    case INBOUND_ACH_TRANSFER_CREATED = 'inbound_ach_transfer.created';

    case INBOUND_ACH_TRANSFER_UPDATED = 'inbound_ach_transfer.updated';

    case INBOUND_ACH_TRANSFER_RETURN_CREATED = 'inbound_ach_transfer_return.created';

    case INBOUND_ACH_TRANSFER_RETURN_UPDATED = 'inbound_ach_transfer_return.updated';

    case INBOUND_CHECK_DEPOSIT_CREATED = 'inbound_check_deposit.created';

    case INBOUND_CHECK_DEPOSIT_UPDATED = 'inbound_check_deposit.updated';

    case INBOUND_FEDNOW_TRANSFER_CREATED = 'inbound_fednow_transfer.created';

    case INBOUND_FEDNOW_TRANSFER_UPDATED = 'inbound_fednow_transfer.updated';

    case INBOUND_MAIL_ITEM_CREATED = 'inbound_mail_item.created';

    case INBOUND_MAIL_ITEM_UPDATED = 'inbound_mail_item.updated';

    case INBOUND_REAL_TIME_PAYMENTS_TRANSFER_CREATED = 'inbound_real_time_payments_transfer.created';

    case INBOUND_REAL_TIME_PAYMENTS_TRANSFER_UPDATED = 'inbound_real_time_payments_transfer.updated';

    case INBOUND_WIRE_DRAWDOWN_REQUEST_CREATED = 'inbound_wire_drawdown_request.created';

    case INBOUND_WIRE_TRANSFER_CREATED = 'inbound_wire_transfer.created';

    case INBOUND_WIRE_TRANSFER_UPDATED = 'inbound_wire_transfer.updated';

    case INTRAFI_ACCOUNT_ENROLLMENT_CREATED = 'intrafi_account_enrollment.created';

    case INTRAFI_ACCOUNT_ENROLLMENT_UPDATED = 'intrafi_account_enrollment.updated';

    case INTRAFI_EXCLUSION_CREATED = 'intrafi_exclusion.created';

    case INTRAFI_EXCLUSION_UPDATED = 'intrafi_exclusion.updated';

    case LEGACY_CARD_DISPUTE_CREATED = 'legacy_card_dispute.created';

    case LEGACY_CARD_DISPUTE_UPDATED = 'legacy_card_dispute.updated';

    case LOCKBOX_CREATED = 'lockbox.created';

    case LOCKBOX_UPDATED = 'lockbox.updated';

    case OAUTH_CONNECTION_CREATED = 'oauth_connection.created';

    case OAUTH_CONNECTION_DEACTIVATED = 'oauth_connection.deactivated';

    case CARD_PUSH_TRANSFER_CREATED = 'card_push_transfer.created';

    case CARD_PUSH_TRANSFER_UPDATED = 'card_push_transfer.updated';

    case CARD_VALIDATION_CREATED = 'card_validation.created';

    case CARD_VALIDATION_UPDATED = 'card_validation.updated';

    case PENDING_TRANSACTION_CREATED = 'pending_transaction.created';

    case PENDING_TRANSACTION_UPDATED = 'pending_transaction.updated';

    case PHYSICAL_CARD_CREATED = 'physical_card.created';

    case PHYSICAL_CARD_UPDATED = 'physical_card.updated';

    case PHYSICAL_CARD_PROFILE_CREATED = 'physical_card_profile.created';

    case PHYSICAL_CARD_PROFILE_UPDATED = 'physical_card_profile.updated';

    case PHYSICAL_CHECK_CREATED = 'physical_check.created';

    case PHYSICAL_CHECK_UPDATED = 'physical_check.updated';

    case PROGRAM_CREATED = 'program.created';

    case PROGRAM_UPDATED = 'program.updated';

    case PROOF_OF_AUTHORIZATION_REQUEST_CREATED = 'proof_of_authorization_request.created';

    case PROOF_OF_AUTHORIZATION_REQUEST_UPDATED = 'proof_of_authorization_request.updated';

    case REAL_TIME_DECISION_CARD_AUTHORIZATION_REQUESTED = 'real_time_decision.card_authorization_requested';

    case REAL_TIME_DECISION_CARD_BALANCE_INQUIRY_REQUESTED = 'real_time_decision.card_balance_inquiry_requested';

    case REAL_TIME_DECISION_DIGITAL_WALLET_TOKEN_REQUESTED = 'real_time_decision.digital_wallet_token_requested';

    case REAL_TIME_DECISION_DIGITAL_WALLET_AUTHENTICATION_REQUESTED = 'real_time_decision.digital_wallet_authentication_requested';

    case REAL_TIME_DECISION_CARD_AUTHENTICATION_REQUESTED = 'real_time_decision.card_authentication_requested';

    case REAL_TIME_DECISION_CARD_AUTHENTICATION_CHALLENGE_REQUESTED = 'real_time_decision.card_authentication_challenge_requested';

    case REAL_TIME_PAYMENTS_TRANSFER_CREATED = 'real_time_payments_transfer.created';

    case REAL_TIME_PAYMENTS_TRANSFER_UPDATED = 'real_time_payments_transfer.updated';

    case REAL_TIME_PAYMENTS_REQUEST_FOR_PAYMENT_CREATED = 'real_time_payments_request_for_payment.created';

    case REAL_TIME_PAYMENTS_REQUEST_FOR_PAYMENT_UPDATED = 'real_time_payments_request_for_payment.updated';

    case SWIFT_TRANSFER_CREATED = 'swift_transfer.created';

    case SWIFT_TRANSFER_UPDATED = 'swift_transfer.updated';

    case TRANSACTION_CREATED = 'transaction.created';

    case WIRE_DRAWDOWN_REQUEST_CREATED = 'wire_drawdown_request.created';

    case WIRE_DRAWDOWN_REQUEST_UPDATED = 'wire_drawdown_request.updated';

    case WIRE_TRANSFER_CREATED = 'wire_transfer.created';

    case WIRE_TRANSFER_UPDATED = 'wire_transfer.updated';
}
