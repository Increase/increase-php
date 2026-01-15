<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute Chargeback Timed Out Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `chargeback_timed_out`. Contains the details specific to a chargeback timed out Visa Card Dispute Network Event, which represents that the chargeback has timed out in the user's favor.
 *
 * @phpstan-type ChargebackTimedOutShape = array<string,mixed>
 */
final class ChargebackTimedOut implements BaseModel
{
    /** @use SdkModel<ChargebackTimedOutShape> */
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
