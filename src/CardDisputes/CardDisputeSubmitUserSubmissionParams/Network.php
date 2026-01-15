<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams;

/**
 * The network of the Card Dispute. Details specific to the network are required under the sub-object with the same identifier as the network.
 */
enum Network: string
{
    case VISA = 'visa';
}
