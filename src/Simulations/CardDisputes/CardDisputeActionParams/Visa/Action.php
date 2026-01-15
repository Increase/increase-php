<?php

declare(strict_types=1);

namespace Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

/**
 * The action to take. Details specific to the action are required under the sub-object with the same identifier as the action.
 */
enum Action: string
{
    case ACCEPT_CHARGEBACK = 'accept_chargeback';

    case ACCEPT_USER_SUBMISSION = 'accept_user_submission';

    case DECLINE_USER_PREARBITRATION = 'decline_user_prearbitration';

    case RECEIVE_MERCHANT_PREARBITRATION = 'receive_merchant_prearbitration';

    case REPRESENT = 'represent';

    case REQUEST_FURTHER_INFORMATION = 'request_further_information';

    case TIME_OUT_CHARGEBACK = 'time_out_chargeback';

    case TIME_OUT_MERCHANT_PREARBITRATION = 'time_out_merchant_prearbitration';

    case TIME_OUT_REPRESENTMENT = 'time_out_representment';

    case TIME_OUT_USER_PREARBITRATION = 'time_out_user_prearbitration';
}
