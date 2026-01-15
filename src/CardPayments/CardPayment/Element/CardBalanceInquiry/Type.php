<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardBalanceInquiry;

/**
 * A constant representing the object's type. For this resource it will always be `card_balance_inquiry`.
 */
enum Type: string
{
    case CARD_BALANCE_INQUIRY = 'card_balance_inquiry';
}
