<?php

declare(strict_types=1);

namespace Increase\Cards\Card\ReplacementFor;

/**
 * Why the Card was replaced. Only `expiring` notifies merchants that have the replaced Card on file of the new Card.
 */
enum Reason: string
{
    case EXPIRING = 'expiring';

    case LOST = 'lost';

    case STOLEN = 'stolen';

    case FRAUD = 'fraud';
}
