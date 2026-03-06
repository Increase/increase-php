<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication;

/**
 * Indicates whether a challenge is requested for this transaction.
 */
enum RequestorChallengeIndicator: string
{
    case NO_PREFERENCE = 'no_preference';

    case NO_CHALLENGE_REQUESTED = 'no_challenge_requested';

    case CHALLENGE_REQUESTED_3DS_REQUESTOR_PREFERENCE = 'challenge_requested_3ds_requestor_preference';

    case CHALLENGE_REQUESTED_MANDATE = 'challenge_requested_mandate';

    case NO_CHALLENGE_REQUESTED_TRANSACTIONAL_RISK_ANALYSIS_ALREADY_PERFORMED = 'no_challenge_requested_transactional_risk_analysis_already_performed';

    case NO_CHALLENGE_REQUESTED_DATA_SHARE_ONLY = 'no_challenge_requested_data_share_only';

    case NO_CHALLENGE_REQUESTED_STRONG_CONSUMER_AUTHENTICATION_ALREADY_PERFORMED = 'no_challenge_requested_strong_consumer_authentication_already_performed';

    case NO_CHALLENGE_REQUESTED_UTILIZE_WHITELIST_EXEMPTION_IF_NO_CHALLENGE_REQUIRED = 'no_challenge_requested_utilize_whitelist_exemption_if_no_challenge_required';

    case CHALLENGE_REQUESTED_WHITELIST_PROMPT_REQUESTED_IF_CHALLENGE_REQUIRED = 'challenge_requested_whitelist_prompt_requested_if_challenge_required';
}
