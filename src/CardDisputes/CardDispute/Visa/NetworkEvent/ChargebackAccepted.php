<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Dispute Chargeback Accepted Visa Network Event object. This field will be present in the JSON response if and only if `category` is equal to `chargeback_accepted`. Contains the details specific to a chargeback accepted Visa Card Dispute Network Event, which represents that a chargeback has been accepted by the merchant.
 *
 * @phpstan-type ChargebackAcceptedShape = array<string,mixed>
 */
final class ChargebackAccepted implements BaseModel
{
    /** @use SdkModel<ChargebackAcceptedShape> */
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
