<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\MessageCategory\Payment;

/**
 * The type of transaction being authenticated.
 */
enum TransactionType: string
{
    case GOODS_SERVICE_PURCHASE = 'goods_service_purchase';

    case CHECK_ACCEPTANCE = 'check_acceptance';

    case ACCOUNT_FUNDING = 'account_funding';

    case QUASI_CASH_TRANSACTION = 'quasi_cash_transaction';

    case PREPAID_ACTIVATION_AND_LOAD = 'prepaid_activation_and_load';
}
