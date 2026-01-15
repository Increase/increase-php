<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute User Pre-Arbitration Accepted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_accepted`. Contains the details specific to a user prearbitration accepted Visa Card Dispute Network Event, which represents that the merchant has accepted the user's prearbitration request in the user's favor.
 *
 * @phpstan-type UserPrearbitrationAcceptedShape = array<string,mixed>
 */
final class UserPrearbitrationAccepted implements BaseModel
{
    /** @use SdkModel<UserPrearbitrationAcceptedShape> */
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
