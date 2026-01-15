<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry;

/**
 * Whether the card balance inquiry should be approved or declined.
 */
enum Decision: string
{
    case APPROVE = 'approve';

    case DECLINE = 'decline';
}
