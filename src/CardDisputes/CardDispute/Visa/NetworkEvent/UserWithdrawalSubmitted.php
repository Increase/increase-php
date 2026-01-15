<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute User Withdrawal Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_withdrawal_submitted`. Contains the details specific to a user withdrawal submitted Visa Card Dispute Network Event, which represents that the user's request to withdraw the dispute has been submitted to the network.
 *
 * @phpstan-type UserWithdrawalSubmittedShape = array<string,mixed>
 */
final class UserWithdrawalSubmitted implements BaseModel
{
    /** @use SdkModel<UserWithdrawalSubmittedShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
