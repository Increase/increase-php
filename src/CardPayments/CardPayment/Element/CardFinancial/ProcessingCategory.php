<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardFinancial;

/**
 * The processing category describes the intent behind the financial, such as whether it was used for bill payments or an automatic fuel dispenser.
 */
enum ProcessingCategory: string
{
    case ACCOUNT_FUNDING = 'account_funding';

    case AUTOMATIC_FUEL_DISPENSER = 'automatic_fuel_dispenser';

    case BILL_PAYMENT = 'bill_payment';

    case ORIGINAL_CREDIT = 'original_credit';

    case PURCHASE = 'purchase';

    case QUASI_CASH = 'quasi_cash';

    case REFUND = 'refund';

    case CASH_DISBURSEMENT = 'cash_disbursement';

    case BALANCE_INQUIRY = 'balance_inquiry';

    case UNKNOWN = 'unknown';
}
