<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardReversal;

/**
 * Why this reversal was initiated.
 */
enum ReversalReason: string
{
    case REVERSED_BY_CUSTOMER = 'reversed_by_customer';

    case REVERSED_BY_NETWORK_OR_ACQUIRER = 'reversed_by_network_or_acquirer';

    case REVERSED_BY_POINT_OF_SALE = 'reversed_by_point_of_sale';

    case PARTIAL_REVERSAL = 'partial_reversal';
}
