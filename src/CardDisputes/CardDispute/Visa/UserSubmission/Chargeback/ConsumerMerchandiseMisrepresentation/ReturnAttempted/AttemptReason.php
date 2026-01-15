<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\ReturnAttempted;

/**
 * Attempt reason.
 */
enum AttemptReason: string
{
    case MERCHANT_NOT_RESPONDING = 'merchant_not_responding';

    case NO_RETURN_AUTHORIZATION_PROVIDED = 'no_return_authorization_provided';

    case NO_RETURN_INSTRUCTIONS = 'no_return_instructions';

    case REQUESTED_NOT_TO_RETURN = 'requested_not_to_return';

    case RETURN_NOT_ACCEPTED = 'return_not_accepted';
}
