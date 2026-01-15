<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCards\PhysicalCard\Shipment\Address;
use Increase\PhysicalCards\PhysicalCard\Shipment\Method;
use Increase\PhysicalCards\PhysicalCard\Shipment\Schedule;
use Increase\PhysicalCards\PhysicalCard\Shipment\Status;
use Increase\PhysicalCards\PhysicalCard\Shipment\Tracking;

/**
 * The details used to ship this physical card.
 *
 * @phpstan-import-type AddressShape from \Increase\PhysicalCards\PhysicalCard\Shipment\Address
 * @phpstan-import-type TrackingShape from \Increase\PhysicalCards\PhysicalCard\Shipment\Tracking
 *
 * @phpstan-type ShipmentShape = array{
 *   address: Address|AddressShape,
 *   method: Method|value-of<Method>,
 *   schedule: Schedule|value-of<Schedule>,
 *   status: \Increase\PhysicalCards\PhysicalCard\Shipment\Status|value-of<\Increase\PhysicalCards\PhysicalCard\Shipment\Status>,
 *   tracking: null|Tracking|TrackingShape,
 * }
 */
final class Shipment implements BaseModel
{
    /** @use SdkModel<ShipmentShape> */
    use SdkModel;

    /**
     * The location to where the card's packing label is addressed.
     */
    #[Required]
    public Address $address;

    /**
     * The shipping method.
     *
     * @var value-of<Method> $method
     */
    #[Required(enum: Method::class)]
    public string $method;

    /**
     * When this physical card should be produced by the card printer. The default timeline is the day after the card printer receives the order, except for `FEDEX_PRIORITY_OVERNIGHT` cards, which default to `SAME_DAY`. To use faster production methods, please reach out to [support@increase.com](mailto:support@increase.com).
     *
     * @var value-of<Schedule> $schedule
     */
    #[Required(enum: Schedule::class)]
    public string $schedule;

    /**
     * The status of this shipment.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Tracking details for the shipment.
     */
    #[Required]
    public ?Tracking $tracking;

    /**
     * `new Shipment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Shipment::with(
     *   address: ..., method: ..., schedule: ..., status: ..., tracking: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Shipment)
     *   ->withAddress(...)
     *   ->withMethod(...)
     *   ->withSchedule(...)
     *   ->withStatus(...)
     *   ->withTracking(...)
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
     * @param Address|AddressShape $address
     * @param Method|value-of<Method> $method
     * @param Schedule|value-of<Schedule> $schedule
     * @param Status|value-of<Status> $status
     * @param Tracking|TrackingShape|null $tracking
     */
    public static function with(
        Address|array $address,
        Method|string $method,
        Schedule|string $schedule,
        Status|string $status,
        Tracking|array|null $tracking,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['method'] = $method;
        $self['schedule'] = $schedule;
        $self['status'] = $status;
        $self['tracking'] = $tracking;

        return $self;
    }

    /**
     * The location to where the card's packing label is addressed.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(Address|array $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * The shipping method.
     *
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * When this physical card should be produced by the card printer. The default timeline is the day after the card printer receives the order, except for `FEDEX_PRIORITY_OVERNIGHT` cards, which default to `SAME_DAY`. To use faster production methods, please reach out to [support@increase.com](mailto:support@increase.com).
     *
     * @param Schedule|value-of<Schedule> $schedule
     */
    public function withSchedule(Schedule|string $schedule): self
    {
        $self = clone $this;
        $self['schedule'] = $schedule;

        return $self;
    }

    /**
     * The status of this shipment.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Tracking details for the shipment.
     *
     * @param Tracking|TrackingShape|null $tracking
     */
    public function withTracking(Tracking|array|null $tracking): self
    {
        $self = clone $this;
        $self['tracking'] = $tracking;

        return $self;
    }
}
