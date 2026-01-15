<?php

declare(strict_types=1);

namespace Increase\PhysicalCards;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCards\PhysicalCardCreateParams\Cardholder;
use Increase\PhysicalCards\PhysicalCardCreateParams\Shipment;

/**
 * Create a Physical Card.
 *
 * @see Increase\Services\PhysicalCardsService::create()
 *
 * @phpstan-import-type CardholderShape from \Increase\PhysicalCards\PhysicalCardCreateParams\Cardholder
 * @phpstan-import-type ShipmentShape from \Increase\PhysicalCards\PhysicalCardCreateParams\Shipment
 *
 * @phpstan-type PhysicalCardCreateParamsShape = array{
 *   cardID: string,
 *   cardholder: Cardholder|CardholderShape,
 *   shipment: Shipment|ShipmentShape,
 *   physicalCardProfileID?: string|null,
 * }
 */
final class PhysicalCardCreateParams implements BaseModel
{
    /** @use SdkModel<PhysicalCardCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The underlying card representing this physical card.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * Details about the cardholder, as it will appear on the physical card.
     */
    #[Required]
    public Cardholder $cardholder;

    /**
     * The details used to ship this physical card.
     */
    #[Required]
    public Shipment $shipment;

    /**
     * The physical card profile to use for this physical card. The latest default physical card profile will be used if not provided.
     */
    #[Optional('physical_card_profile_id')]
    public ?string $physicalCardProfileID;

    /**
     * `new PhysicalCardCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCardCreateParams::with(cardID: ..., cardholder: ..., shipment: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCardCreateParams)
     *   ->withCardID(...)
     *   ->withCardholder(...)
     *   ->withShipment(...)
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
     * @param Cardholder|CardholderShape $cardholder
     * @param Shipment|ShipmentShape $shipment
     */
    public static function with(
        string $cardID,
        Cardholder|array $cardholder,
        Shipment|array $shipment,
        ?string $physicalCardProfileID = null,
    ): self {
        $self = new self;

        $self['cardID'] = $cardID;
        $self['cardholder'] = $cardholder;
        $self['shipment'] = $shipment;

        null !== $physicalCardProfileID && $self['physicalCardProfileID'] = $physicalCardProfileID;

        return $self;
    }

    /**
     * The underlying card representing this physical card.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * Details about the cardholder, as it will appear on the physical card.
     *
     * @param Cardholder|CardholderShape $cardholder
     */
    public function withCardholder(Cardholder|array $cardholder): self
    {
        $self = clone $this;
        $self['cardholder'] = $cardholder;

        return $self;
    }

    /**
     * The details used to ship this physical card.
     *
     * @param Shipment|ShipmentShape $shipment
     */
    public function withShipment(Shipment|array $shipment): self
    {
        $self = clone $this;
        $self['shipment'] = $shipment;

        return $self;
    }

    /**
     * The physical card profile to use for this physical card. The latest default physical card profile will be used if not provided.
     */
    public function withPhysicalCardProfileID(
        string $physicalCardProfileID
    ): self {
        $self = clone $this;
        $self['physicalCardProfileID'] = $physicalCardProfileID;

        return $self;
    }
}
