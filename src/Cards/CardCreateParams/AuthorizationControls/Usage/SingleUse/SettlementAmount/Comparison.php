<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams\AuthorizationControls\Usage\SingleUse\SettlementAmount;

/**
 * The operator used to compare the settlement amount.
 */
enum Comparison: string
{
    case EQUALS = 'equals';

    case LESS_THAN_OR_EQUALS = 'less_than_or_equals';
}
