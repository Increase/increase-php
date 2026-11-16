<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams;

/**
 * The network of the disputed transaction. Details specific to the network can be provided under the sub-object with the same identifier as the network.
 */
enum Network: string
{
    case VISA = 'visa';
}
