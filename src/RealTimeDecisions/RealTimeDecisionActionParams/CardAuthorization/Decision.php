<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization;

/**
 * Whether the card authorization should be approved or declined.
 */
enum Decision: string
{
    case APPROVE = 'approve';

    case DECLINE = 'decline';
}
