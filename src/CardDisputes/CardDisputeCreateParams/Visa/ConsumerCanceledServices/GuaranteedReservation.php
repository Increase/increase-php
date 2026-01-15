<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices\GuaranteedReservation\Explanation;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Guaranteed reservation explanation. Required if and only if `service_type` is `guaranteed_reservation`.
 *
 * @phpstan-type GuaranteedReservationShape = array{
 *   explanation: Explanation|value-of<Explanation>
 * }
 */
final class GuaranteedReservation implements BaseModel
{
    /** @use SdkModel<GuaranteedReservationShape> */
    use SdkModel;

    /**
     * Explanation.
     *
     * @var value-of<Explanation> $explanation
     */
    #[Required(enum: Explanation::class)]
    public string $explanation;

    /**
     * `new GuaranteedReservation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GuaranteedReservation::with(explanation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GuaranteedReservation)->withExplanation(...)
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
     *
     * @param Explanation|value-of<Explanation> $explanation
     */
    public static function with(Explanation|string $explanation): self
    {
        $self = new self;

        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * Explanation.
     *
     * @param Explanation|value-of<Explanation> $explanation
     */
    public function withExplanation(Explanation|string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }
}
