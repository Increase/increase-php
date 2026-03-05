<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel\MerchantInitiated;

/**
 * The merchant initiated indicator for the transaction.
 */
enum Indicator: string
{
    case RECURRING_TRANSACTION = 'recurring_transaction';

    case INSTALLMENT_TRANSACTION = 'installment_transaction';

    case ADD_CARD = 'add_card';

    case MAINTAIN_CARD_INFORMATION = 'maintain_card_information';

    case ACCOUNT_VERIFICATION = 'account_verification';

    case SPLIT_DELAYED_SHIPMENT = 'split_delayed_shipment';

    case TOP_UP = 'top_up';

    case MAIL_ORDER = 'mail_order';

    case TELEPHONE_ORDER = 'telephone_order';

    case WHITELIST_STATUS_CHECK = 'whitelist_status_check';

    case OTHER_PAYMENT = 'other_payment';

    case BILLING_AGREEMENT = 'billing_agreement';

    case DEVICE_BINDING_STATUS_CHECK = 'device_binding_status_check';

    case CARD_SECURITY_CODE_STATUS_CHECK = 'card_security_code_status_check';

    case DELAYED_SHIPMENT = 'delayed_shipment';

    case SPLIT_PAYMENT = 'split_payment';

    case FIDO_CREDENTIAL_DELETION = 'fido_credential_deletion';

    case FIDO_CREDENTIAL_REGISTRATION = 'fido_credential_registration';

    case DECOUPLED_AUTHENTICATION_FALLBACK = 'decoupled_authentication_fallback';
}
