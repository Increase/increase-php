<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCardCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCards\PhysicalCardCreateParams\Shipment\Address;
use Increase\PhysicalCards\PhysicalCardCreateParams\Shipment\Method;
use Increase\PhysicalCards\PhysicalCardCreateParams\Shipment\Schedule;

/**
 * The details used to ship this physical card.
 *
 * @phpstan-import-type AddressShape from \Increase\PhysicalCards\PhysicalCardCreateParams\Shipment\Address
 *
 * @phpstan-type ShipmentShape = array{
 *   address: Address|AddressShape,
 *   method: Method|value-of<Method>,
 *   schedule?: null|Schedule|value-of<Schedule>,
 * }
 */
final class Shipment implements BaseModel
{
    /** @use SdkModel<ShipmentShape> */
    use SdkModel;

    /**
     * The address to where the card should be shipped.
     */
    #[Required]
    public Address $address;

    /**
     * The shipping method to use.
     *
     * @var value-of<Method> $method
     */
    #[Required(enum: Method::class)]
    public string $method;

    /**
     * When this physical card should be produced by the card printer. The default timeline is the day after the card printer receives the order, except for `FEDEX_PRIORITY_OVERNIGHT` cards, which default to `SAME_DAY`. To use faster production methods, please reach out to [support@increase.com](mailto:support@increase.com).
     *
     * @var value-of<Schedule>|null $schedule
     */
    #[Optional(enum: Schedule::class)]
    public ?string $schedule;

    /**
     * `new Shipment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Shipment::with(address: ..., method: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Shipment)->withAddress(...)->withMethod(...)
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
     * @param Schedule|value-of<Schedule>|null $schedule
     */
    public static function with(
        Address|array $address,
        Method|string $method,
        Schedule|string|null $schedule = null,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['method'] = $method;

        null !== $schedule && $self['schedule'] = $schedule;

        return $self;
    }

    /**
     * The address to where the card should be shipped.
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
     * The shipping method to use.
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
}
