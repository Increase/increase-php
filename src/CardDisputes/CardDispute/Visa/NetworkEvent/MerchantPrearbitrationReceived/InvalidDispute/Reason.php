<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived\InvalidDispute;

/**
 * The reason a merchant considers the dispute invalid.
 */
enum Reason: string
{
    case OTHER = 'other';

    case SPECIAL_AUTHORIZATION_PROCEDURES_FOLLOWED = 'special_authorization_procedures_followed';
}
