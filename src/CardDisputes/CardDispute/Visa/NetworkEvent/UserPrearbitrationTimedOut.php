<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute User Pre-Arbitration Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_timed_out`. Contains the details specific to a user prearbitration timed out Visa Card Dispute Network Event, which represents that the merchant has timed out responding to the user's prearbitration request.
 *
 * @phpstan-type UserPrearbitrationTimedOutShape = array<string,mixed>
 */
final class UserPrearbitrationTimedOut implements BaseModel
{
    /** @use SdkModel<UserPrearbitrationTimedOutShape> */
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
