<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute User Pre-Arbitration Declined Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_declined`. Contains the details specific to a user prearbitration declined Visa Card Dispute Network Event, which represents that the merchant has declined the user's prearbitration request.
 *
 * @phpstan-type UserPrearbitrationDeclinedShape = array<string,mixed>
 */
final class UserPrearbitrationDeclined implements BaseModel
{
    /** @use SdkModel<UserPrearbitrationDeclinedShape> */
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
