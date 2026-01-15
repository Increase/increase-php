<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CheckDepositReturn;

/**
 * Why this check was returned by the bank holding the account it was drawn against.
 */
enum ReturnReason: string
{
    case ACH_CONVERSION_NOT_SUPPORTED = 'ach_conversion_not_supported';

    case CLOSED_ACCOUNT = 'closed_account';

    case DUPLICATE_SUBMISSION = 'duplicate_submission';

    case INSUFFICIENT_FUNDS = 'insufficient_funds';

    case NO_ACCOUNT = 'no_account';

    case NOT_AUTHORIZED = 'not_authorized';

    case STALE_DATED = 'stale_dated';

    case STOP_PAYMENT = 'stop_payment';

    case UNKNOWN_REASON = 'unknown_reason';

    case UNMATCHED_DETAILS = 'unmatched_details';

    case UNREADABLE_IMAGE = 'unreadable_image';

    case ENDORSEMENT_IRREGULAR = 'endorsement_irregular';

    case ALTERED_OR_FICTITIOUS_ITEM = 'altered_or_fictitious_item';

    case FROZEN_OR_BLOCKED_ACCOUNT = 'frozen_or_blocked_account';

    case POST_DATED = 'post_dated';

    case ENDORSEMENT_MISSING = 'endorsement_missing';

    case SIGNATURE_MISSING = 'signature_missing';

    case STOP_PAYMENT_SUSPECT = 'stop_payment_suspect';

    case UNUSABLE_IMAGE = 'unusable_image';

    case IMAGE_FAILS_SECURITY_CHECK = 'image_fails_security_check';

    case CANNOT_DETERMINE_AMOUNT = 'cannot_determine_amount';

    case SIGNATURE_IRREGULAR = 'signature_irregular';

    case NON_CASH_ITEM = 'non_cash_item';

    case UNABLE_TO_PROCESS = 'unable_to_process';

    case ITEM_EXCEEDS_DOLLAR_LIMIT = 'item_exceeds_dollar_limit';

    case BRANCH_OR_ACCOUNT_SOLD = 'branch_or_account_sold';
}
