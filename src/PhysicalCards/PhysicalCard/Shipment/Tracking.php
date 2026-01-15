<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard\Shipment;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCards\PhysicalCard\Shipment\Tracking\Update;

/**
 * Tracking details for the shipment.
 *
 * @phpstan-import-type UpdateShape from \Increase\PhysicalCards\PhysicalCard\Shipment\Tracking\Update
 *
 * @phpstan-type TrackingShape = array{
 *   number: string|null,
 *   returnNumber: string|null,
 *   returnReason: string|null,
 *   shippedAt: \DateTimeInterface,
 *   updates: list<Update|UpdateShape>,
 * }
 */
final class Tracking implements BaseModel
{
    /** @use SdkModel<TrackingShape> */
    use SdkModel;

    /**
     * The tracking number. Not available for USPS shipments.
     */
    #[Required]
    public ?string $number;

    /**
     * For returned shipments, the tracking number of the return shipment.
     */
    #[Required('return_number')]
    public ?string $returnNumber;

    /**
     * For returned shipments, this describes why the package was returned.
     */
    #[Required('return_reason')]
    public ?string $returnReason;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the fulfillment provider marked the card as ready for pick-up by the shipment carrier.
     */
    #[Required('shipped_at')]
    public \DateTimeInterface $shippedAt;

    /**
     * Tracking updates relating to the physical card's delivery.
     *
     * @var list<Update> $updates
     */
    #[Required(list: Update::class)]
    public array $updates;

    /**
     * `new Tracking()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Tracking::with(
     *   number: ...,
     *   returnNumber: ...,
     *   returnReason: ...,
     *   shippedAt: ...,
     *   updates: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Tracking)
     *   ->withNumber(...)
     *   ->withReturnNumber(...)
     *   ->withReturnReason(...)
     *   ->withShippedAt(...)
     *   ->withUpdates(...)
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
     * @param list<Update|UpdateShape> $updates
     */
    public static function with(
        ?string $number,
        ?string $returnNumber,
        ?string $returnReason,
        \DateTimeInterface $shippedAt,
        array $updates,
    ): self {
        $self = new self;

        $self['number'] = $number;
        $self['returnNumber'] = $returnNumber;
        $self['returnReason'] = $returnReason;
        $self['shippedAt'] = $shippedAt;
        $self['updates'] = $updates;

        return $self;
    }

    /**
     * The tracking number. Not available for USPS shipments.
     */
    public function withNumber(?string $number): self
    {
        $self = clone $this;
        $self['number'] = $number;

        return $self;
    }

    /**
     * For returned shipments, the tracking number of the return shipment.
     */
    public function withReturnNumber(?string $returnNumber): self
    {
        $self = clone $this;
        $self['returnNumber'] = $returnNumber;

        return $self;
    }

    /**
     * For returned shipments, this describes why the package was returned.
     */
    public function withReturnReason(?string $returnReason): self
    {
        $self = clone $this;
        $self['returnReason'] = $returnReason;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the fulfillment provider marked the card as ready for pick-up by the shipment carrier.
     */
    public function withShippedAt(\DateTimeInterface $shippedAt): self
    {
        $self = clone $this;
        $self['shippedAt'] = $shippedAt;

        return $self;
    }

    /**
     * Tracking updates relating to the physical card's delivery.
     *
     * @param list<Update|UpdateShape> $updates
     */
    public function withUpdates(array $updates): self
    {
        $self = clone $this;
        $self['updates'] = $updates;

        return $self;
    }
}
