<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\CompellingEvidence;

/**
 * The category of compelling evidence provided by the merchant.
 */
enum Category: string
{
    case AUTHORIZED_SIGNER = 'authorized_signer';

    case DELIVERY = 'delivery';

    case DELIVERY_AT_PLACE_OF_EMPLOYMENT = 'delivery_at_place_of_employment';

    case DIGITAL_GOODS_DOWNLOAD = 'digital_goods_download';

    case DYNAMIC_CURRENCY_CONVERSION_ACTIVELY_CHOSEN = 'dynamic_currency_conversion_actively_chosen';

    case FLIGHT_MANIFEST_AND_PURCHASE_ITINERARY = 'flight_manifest_and_purchase_itinerary';

    case HOUSEHOLD_MEMBER_SIGNER = 'household_member_signer';

    case LEGITIMATE_SPEND_ACROSS_PAYMENT_TYPES_FOR_SAME_MERCHANDISE = 'legitimate_spend_across_payment_types_for_same_merchandise';

    case MERCHANDISE_USE = 'merchandise_use';

    case PASSENGER_TRANSPORT_TICKET_USE = 'passenger_transport_ticket_use';

    case RECURRING_TRANSACTION_WITH_BINDING_CONTRACT_OR_PREVIOUS_UNDISPUTED_TRANSACTION = 'recurring_transaction_with_binding_contract_or_previous_undisputed_transaction';

    case SIGNED_DELIVERY_OR_PICKUP_FORM = 'signed_delivery_or_pickup_form';

    case SIGNED_MAIL_ORDER_PHONE_ORDER_FORM = 'signed_mail_order_phone_order_form';

    case TRAVEL_AND_EXPENSE_LOYALTY_TRANSACTION = 'travel_and_expense_loyalty_transaction';

    case TRAVEL_AND_EXPENSE_SUBSEQUENT_PURCHASE = 'travel_and_expense_subsequent_purchase';
}
