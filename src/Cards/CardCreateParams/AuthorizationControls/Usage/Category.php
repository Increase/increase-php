<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams\AuthorizationControls\Usage;

/**
 * Whether the card is for a single use or multiple uses.
 */
enum Category: string
{
    case SINGLE_USE = 'single_use';

    case MULTI_USE = 'multi_use';
}
