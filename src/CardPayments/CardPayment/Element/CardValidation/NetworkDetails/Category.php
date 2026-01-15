<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardValidation\NetworkDetails;

/**
 * The payment network used to process this card authorization.
 */
enum Category: string
{
    case VISA = 'visa';

    case PULSE = 'pulse';
}
