<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams\ReplacementFor;

/**
 * Why the Card is being replaced. Only `expiring` notifies merchants that have the replaced Card on file of the new Card and moves Digital Wallet Tokens on the replaced Card that have not been deactivated to the new Card.
 */
enum Reason: string
{
    case EXPIRING = 'expiring';

    case LOST = 'lost';

    case STOLEN = 'stolen';

    case FRAUD = 'fraud';
}
