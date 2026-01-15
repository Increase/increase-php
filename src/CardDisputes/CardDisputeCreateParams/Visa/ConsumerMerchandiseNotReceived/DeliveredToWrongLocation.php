<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerMerchandiseNotReceived;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Delivered to wrong location. Required if and only if `delivery_issue` is `delivered_to_wrong_location`.
 *
 * @phpstan-type DeliveredToWrongLocationShape = array{agreedLocation: string}
 */
final class DeliveredToWrongLocation implements BaseModel
{
    /** @use SdkModel<DeliveredToWrongLocationShape> */
    use SdkModel;

    /**
     * Agreed location.
     */
    #[Required('agreed_location')]
    public string $agreedLocation;

    /**
     * `new DeliveredToWrongLocation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeliveredToWrongLocation::with(agreedLocation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeliveredToWrongLocation)->withAgreedLocation(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $agreedLocation): self
    {
        $self = new self;

        $self['agreedLocation'] = $agreedLocation;

        return $self;
    }

    /**
     * Agreed location.
     */
    public function withAgreedLocation(string $agreedLocation): self
    {
        $self = clone $this;
        $self['agreedLocation'] = $agreedLocation;

        return $self;
    }
}
