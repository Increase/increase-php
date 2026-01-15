<?php

declare(strict_types=1);

namespace Increase\Simulations\PhysicalCards;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\PhysicalCards\PhysicalCardAdvanceShipmentParams\ShipmentStatus;

/**
 * This endpoint allows you to simulate advancing the shipment status of a Physical Card, to simulate e.g., that a physical card was attempted shipped but then failed delivery.
 *
 * @see Increase\Services\Simulations\PhysicalCardsService::advanceShipment()
 *
 * @phpstan-type PhysicalCardAdvanceShipmentParamsShape = array{
 *   shipmentStatus: ShipmentStatus|value-of<ShipmentStatus>
 * }
 */
final class PhysicalCardAdvanceShipmentParams implements BaseModel
{
    /** @use SdkModel<PhysicalCardAdvanceShipmentParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The shipment status to move the Physical Card to.
     *
     * @var value-of<ShipmentStatus> $shipmentStatus
     */
    #[Required('shipment_status', enum: ShipmentStatus::class)]
    public string $shipmentStatus;

    /**
     * `new PhysicalCardAdvanceShipmentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCardAdvanceShipmentParams::with(shipmentStatus: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCardAdvanceShipmentParams)->withShipmentStatus(...)
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
     * @param ShipmentStatus|value-of<ShipmentStatus> $shipmentStatus
     */
    public static function with(ShipmentStatus|string $shipmentStatus): self
    {
        $self = new self;

        $self['shipmentStatus'] = $shipmentStatus;

        return $self;
    }

    /**
     * The shipment status to move the Physical Card to.
     *
     * @param ShipmentStatus|value-of<ShipmentStatus> $shipmentStatus
     */
    public function withShipmentStatus(
        ShipmentStatus|string $shipmentStatus
    ): self {
        $self = clone $this;
        $self['shipmentStatus'] = $shipmentStatus;

        return $self;
    }
}
