<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\RiskRating;

/**
 * The rating given to this entity.
 */
enum Rating: string
{
    case LOW = 'low';

    case MEDIUM = 'medium';

    case HIGH = 'high';
}
