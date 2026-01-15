<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransferCreateParams;

/**
 * The Business Application Identifier describes the type of transaction being performed. Your program must be approved for the specified Business Application Identifier in order to use it.
 */
enum BusinessApplicationIdentifier: string
{
    case ACCOUNT_TO_ACCOUNT = 'account_to_account';

    case BUSINESS_TO_BUSINESS = 'business_to_business';

    case MONEY_TRANSFER_BANK_INITIATED = 'money_transfer_bank_initiated';

    case NON_CARD_BILL_PAYMENT = 'non_card_bill_payment';

    case CONSUMER_BILL_PAYMENT = 'consumer_bill_payment';

    case CARD_BILL_PAYMENT = 'card_bill_payment';

    case FUNDS_DISBURSEMENT = 'funds_disbursement';

    case FUNDS_TRANSFER = 'funds_transfer';

    case LOYALTY_AND_OFFERS = 'loyalty_and_offers';

    case MERCHANT_DISBURSEMENT = 'merchant_disbursement';

    case MERCHANT_PAYMENT = 'merchant_payment';

    case PERSON_TO_PERSON = 'person_to_person';

    case TOP_UP = 'top_up';

    case WALLET_TRANSFER = 'wallet_transfer';
}
