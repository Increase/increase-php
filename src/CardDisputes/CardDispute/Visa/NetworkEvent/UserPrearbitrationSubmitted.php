<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute User Pre-Arbitration Submitted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `user_prearbitration_submitted`. Contains the details specific to a user prearbitration submitted Visa Card Dispute Network Event, which represents that the user's request for prearbitration has been submitted to the network.
 *
 * @phpstan-type UserPrearbitrationSubmittedShape = array<string,mixed>
 */
final class UserPrearbitrationSubmitted implements BaseModel
{
    /** @use SdkModel<UserPrearbitrationSubmittedShape> */
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
